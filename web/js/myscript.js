/* 
* @Author: ido_alit
* @Date:   2017-03-21 03:10:00
* @Last Modified by:   ido_alit
* @Last Modified time: 2017-03-21 14:29:01
*/

'use strict';

(function() {

  $(document).ready(function() {
    $('#pilihfile').change(function() {
      // clear div
      $(document).find('#fields').empty();
      var file = $(this).val();
      if (file.length > 0) {
        $('#sampledata-wrap').removeClass('hide');
        $.getJSON('action.php?sampledata=' + file, function(data) {
          console.log(data);
          var content = '';
          var selectList = '';
          selectList += '<option value="">--pilih tabel--</option>';
          $.each(data.table, function(key,val) {
            selectList += '<option value="'+val+'">'+val+'</option>';
          });
          $.each( data.sampledata, function( key, val ) {
            if (val) {
              content += '<strong>'+val+'</strong>';
              content += '<div class="form-inline">';
              content += '<div class="form-group">';
              content += '<select name="st-'+key+'" class="form-control pilih-tabel">';
              content += selectList;
              content += '</select>';
              content += '</div>';
              content += '<div class="form-group">';
              content += '<select name="sc-'+key+'" class="form-control pilih-kolom">';
              content += '<option value="">--pilih kolom--</option>';
              content += '</select></div>';
              content += '</div><hr>';
            }
          });
          $('#fields').append(content);
        });
      } else {
        $('#sampledata-wrap').addClass('hide');
      }
    });

    $(document).on('change', '.pilih-tabel', function() {
      var thisSelect = $(this);
      var strKolom = thisSelect.val();
      var selectList = '';
      // clear option
      var parent = thisSelect.parents('.form-inline');
      parent.find('.pilih-kolom option').remove();
      $.getJSON('action.php?kolom=' + strKolom, function(data) {
        console.log(data);
        $.each(data.kolom, function(key,val) {
          selectList += '<option value="'+val+'">'+val+'</option>';
        });
        parent.find('.pilih-kolom').append(selectList);
      });
    });
  });

  $('#s-form').submit(function(e) {
    e.preventDefault();
    var btn = $('#hancurkan');
    var btnOriginText = btn.text();
    btn.text('sedang process ........');
    var data = $(this).serialize();
    $.ajax({
      method: "POST",
      url: "action.php",
      data: data
    })
      .done(function( msg ) {
        btn.text(btnOriginText);
        alert( "Pesan: " + msg );
      });
  });

})();