$(document).on('click', '.side_filter > span', function () {
     $(this).parent().find("#w0").slideToggle("slow");
     $(this).parent().find('span.filter-toggle').toggleClass("default-arrow hidden-filter");

     if (!$(this).hasClass('hidden-filter')) {
          $(this).parent().find('span.filter-toggle').html('Скрыть фильтры');
          $('#assortment .list_products').css({'width': '850px'});
     } else {
          $(this).parent().find('span.filter-toggle').html('Показать фильтры');
          $('#assortment .list_products').css({'width': '100%'});
     }
});

$('#assortment').on('click', '.side_filter .control-label', function () {
     $(this).parent().find("#productssearch-sort").slideToggle("slow");
     $(this).parent().find("#productssearch-country").slideToggle("slow");
     $(this).parent().find("#productssearch-price_sort").slideToggle("slow");
     $(this).parent().find('label.control-label').toggleClass("active_child-arrow active-filter");
});

if ($("#search_title").length) {
     $('#assortment .top_panel_control').css({'display': 'none'});
     $('#assortment .side_filter').css({'display': 'none'});
     $('#assortment .list_products').css({'width': '100%'});
}


