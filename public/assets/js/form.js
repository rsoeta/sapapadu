function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else var expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name,"",-1);
}

$(document).ready(function() {
  $('.js-conditional').conditionize();
  $("form").rememberState({
    clearOnSubmit: false
  });
  autosize($('textarea'));

  $('.js-check-group-required').on('change', function() {
    var group = $(this).data('check-group');

    // if one or more is checked, remove required attribute
    if( $('[data-check-group=' + group + ']:checked').length ) {
      $('[data-check-group=' + group + ']').removeAttr('required');
    }
    else {
      $('[data-check-group=' + group + ']').attr('required', 'required');
    }
  });

  $('[name=lokasi_kondisi_persil]').on('change', function() {
    if( $(this).val() == 'Tanah Kosong' || $('[name=kondisi_masjid_yg_ada]:checked').val() != 'Bangunan Tua' ) {
      $('[name=kondisi_masjid_yg_ada_tahun]').removeAttr('required');
    } else {
      $('[name=kondisi_masjid_yg_ada_tahun]').attr('required', 'required');
    }
  });

  function textareaCount( item ) {
    var count_selector = '.' + $(item).attr('name') + '_count';
    if( $(count_selector).length ) {
      $(count_selector).html($(item).val().length);
    }
  }

  $('textarea[minlength]').each(function(idx) {
    $(this).on('change', function() { textareaCount(this); });
    $(this).on('keyup', function() { textareaCount(this); });
  });

  $("form").submit(function(e){
    e.preventDefault();

    var thisForm = $(this),
        formData = new FormData(this),
        invalid = false, errors = '';

    var submitButton = thisForm.find('[type=submit]');

    thisForm.find('.js-form-message').remove();

    thisForm.find('textarea[minlength]').each(function(idx) {
      if ( $(this).val().length < parseInt( $(this).attr('minlength') ) ) {
        invalid = true;

        errors = errors + '<li>' + $(this).attr('name') + ' harus berisi ' + $(this).attr('minlength') + ' karakter atau lebih.</li>';
      }
    });

    if( invalid ) {
      submitButton.before('<div class="js-form-message alert alert-danger" style="margin-top:2em"><ul>' + errors + '</ul></div>');
      return false;
    }

    submitButton.attr('disabled', 'disabled');
    submitButton.html('Please wait...')

    $.ajax({
      url: thisForm.attr('action'),
      type: thisForm.attr('method'),
      data: formData,
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false
    })
      .done(function (data) {
        if( typeof data.status == 'undefined' || data.status != 'success' ) {
          alert('Terjadi kesalahan');
        } else if( data.status == 'success' ) {
          alert('Sukses');
          window.location.href = base_url + 'success';
        }
      })
      .fail(function ( data ) {
        console.log( data );
        alert('Terjadi kesalahan');
      })
      .always(function () {
        submitButton.removeAttr('disabled');
        submitButton.html('Submit');
      });

    return false;
  });

  $('body')
    // ---------------------------------------
    // preview image before upload
    // ---------------------------------------
    .on('change', 'form [type=file]', function(e) {
      // check file size, no more than 2 MB
      if( this.files[0].size > 2097152) {
        alert('Ukuran file tidak boleh melebihi 2 MB.');
        $(this).replaceWith( $(this).clone() );
        console.log( $(this) );
      }

      if( $(this).data('preview-box') ) {
        $( '#'+$(this).data('preview-box') ).empty().append(
          $('<img class="img-responsive img-thumbnail">').hide().attr('src', URL.createObjectURL(this.files[0])).fadeIn()
        );
      }

      // var parent = $(this).parents('.js-upload-mode');

      // parent.find('input.url').clearInputs();
      // parent.find('.m-upload-preview.-url').empty();

      // parent.find('.m-upload-preview.-file').empty().append(
      //   $('<img>').hide().attr('src', URL.createObjectURL(this.files[0])).fadeIn()
      // );
    });
});
