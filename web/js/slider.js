'use strict';
	    var multiItemSlider = (function () {
	      return function (selector, config) {
	        var
	          _mainElement = document.querySelector(selector), // основный элемент блока
	          _sliderWrapper = _mainElement.querySelector('.slider__wrapper'), // обертка для .slider-item
	          _sliderItems = _mainElement.querySelectorAll('.slider__item'), // элементы (.slider-item)
	          _sliderControls = _mainElement.querySelectorAll('.slider__control'), // элементы управления
	          _sliderControlLeft = _mainElement.querySelector('.slider__control_left'), // кнопка "LEFT"
	          _sliderControlRight = _mainElement.querySelector('.slider__control_right'), // кнопка "RIGHT"
	          _wrapperWidth = parseFloat(getComputedStyle(_sliderWrapper).width), // ширина обёртки
	          _itemWidth = parseFloat(getComputedStyle(_sliderItems[0]).width), // ширина одного элемента
	          _positionLeftItem = 0, // позиция левого активного элемента
	          _transform = 0, // значение транфсофрмации .slider_wrapper
	          _step = _itemWidth / _wrapperWidth * 100, // величина шага (для трансформации)
	          _items = [], // массив элементов
	          _interval = 0,
	          _indexIndicator = 0,
	          _maxIndexIndicator = _sliderItems.length - 1,
	          _indicatorItems,
	          _config = {
	            isCycling: true, // автоматическая смена слайдов
	            direction: 'right', // направление смены слайдов
	            interval: 5000, // интервал между автоматической сменой слайдов
	            pause: true // устанавливать ли паузу при поднесении курсора к слайдеру
	          };

	        for (var key in config) {
	          if (key in _config) {
	            _config[key] = config[key];
	          }
	        }

	        // наполнение массива _items
	        _sliderItems.forEach(function (item, index) {
	          _items.push({ item: item, position: index, transform: 0 });
	        });

	        var position = {
	          getItemMin: function () {
	            var indexItem = 0;
	            _items.forEach(function (item, index) {
	              if (item.position < _items[indexItem].position) {
	                indexItem = index;
	              }
	            });
	            return indexItem;
	          },
	          getItemMax: function () {
	            var indexItem = 0;
	            _items.forEach(function (item, index) {
	              if (item.position > _items[indexItem].position) {
	                indexItem = index;
	              }
	            });
	            return indexItem;
	          },
	          getMin: function () {
	            return _items[position.getItemMin()].position;
	          },
	          getMax: function () {
	            return _items[position.getItemMax()].position;
	          }
	        }

	         var _transformItem = function (direction) {
	          var nextItem, currentIndicator = _indexIndicator;

	          if (direction === 'right') {
	            _positionLeftItem++;
	            if ((_positionLeftItem + _wrapperWidth / _itemWidth - 1) > position.getMax()) {
	              nextItem = position.getItemMin();
	              _items[nextItem].position = position.getMax() + 1;
	              _items[nextItem].transform += _items.length * 100;
	              _items[nextItem].item.style.transform = 'translateX(' + _items[nextItem].transform + '%)';
	            }
	            _transform -= _step;
	            _indexIndicator = _indexIndicator + 1;
	            if (_indexIndicator > _maxIndexIndicator) {
	              _indexIndicator = 0;
	            }
	          }
	          if (direction === 'left') {
	            _positionLeftItem--;
	            if (_positionLeftItem < position.getMin()) {
	              nextItem = position.getItemMax();
	              _items[nextItem].position = position.getMin() - 1;
	              _items[nextItem].transform -= _items.length * 100;
	              _items[nextItem].item.style.transform = 'translateX(' + _items[nextItem].transform + '%)';
	            }
	            _transform += _step;
	            _indexIndicator = _indexIndicator - 1;
	            if (_indexIndicator < 0) {
	              _indexIndicator = _maxIndexIndicator;
	            }
	          }
	          _sliderWrapper.style.transform = 'translateX(' + _transform + '%)';
	          _indicatorItems[currentIndicator].classList.remove('active');
	          _indicatorItems[_indexIndicator].classList.add('active');
	        }

	        var _slideTo = function (to) {
	          var i = 0, direction = (to > _indexIndicator) ? 'right' : 'left';
	          while (to !== _indexIndicator && i <= _maxIndexIndicator) {
	            _transformItem(direction);
	            i++;
	          }
	        }

	        var _cycle = function (direction) {
	          if (!_config.isCycling) {
	            return;
	          }
	          _interval = setInterval(function () {
	            _transformItem(direction);
	          }, _config.interval);
	        }

	        // обработчик события click для кнопок "назад" и "вперед"
	        var _controlClick = function (e) {
		      e.preventDefault();
		      if (e.target.classList.contains('slider__control')) {
		        var direction = e.target.classList.contains('slider__control_right') ? 'right' : 'left';
		        _transformItem(direction);
		        clearInterval(_interval);
		        _cycle(_config.direction);
		      }
		      if (e.target.getAttribute('data-slide-to')) {
		        _slideTo(parseInt(e.target.getAttribute('data-slide-to')));
		        clearInterval(_interval);
		        _cycle(_config.direction);
		      }
		    };

	        var _setUpListeners = function () {
	          // добавление к кнопкам "назад", "вперед", "индикаторам-переключателям" обрботчика _controlClick для событя click
	          _mainElement.addEventListener('click', _controlClick);
	          if (_config.pause && _config.isCycling) {
	            _mainElement.addEventListener('mouseenter', function () {
	              clearInterval(_interval);
	            });
	            _mainElement.addEventListener('mouseleave', function () {
	              clearInterval(_interval);
	              _cycle(_config.direction);
	            });
	          }
	        }

	        var _addIndicators = function () {
	          var sliderIndicators = document.createElement('ol');
	          sliderIndicators.classList.add('slider__indicators');

	          for (var i = 0; i < _sliderItems.length; i++) {
	            var sliderIndicatorsItem = document.createElement('li');
	            if (i === 0) {
	              sliderIndicatorsItem.classList.add('active');
	            }
	            sliderIndicatorsItem.setAttribute("data-slide-to", i);
	            sliderIndicators.appendChild(sliderIndicatorsItem);
	          }
	          _mainElement.appendChild(sliderIndicators);
	          _indicatorItems = _mainElement.querySelectorAll('.slider__indicators > li')
	        }

	        // добавляем индикаторы
	        _addIndicators();
	        // инициализация
	        _setUpListeners();
	        _cycle(_config.direction);

	        return {
	          right: function () { // метод right
	            _transformItem('right');
	          },
	          left: function () { // метод left
	            _transformItem('left');
	          },
	          stop: function () { // метод stop
	            _config.isCycling = false;
	            clearInterval(_interval);
	          },
	          cycle: function () { // метод cycle
	            _config.isCycling = true;
	            clearInterval(_interval);
	            _cycle();
	          }
	        }

	      }
	    }());

	    var slider = multiItemSlider('.slider')