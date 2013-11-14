var
  Wells = {
    init: function() {
      Wells.update();
      setInterval(function() { Wells.update(); }, 2500);

      $('.btn-count').on('click', function(e) {
        var
          $t = $(this),
          v = parseInt($t.text());
        Wells.plus(v);
      });

      $(document).on('keypress', function(e) {
        var
          key = e.which || e.keyCode;

        switch ( key ) {
          case 43:
            Wells.plus(1);
          break;
          case 45:
            Wells.plus(-1);
          break;
        }
      });
    },

    plus: function(val) {
      $.post('/count', {add: val}, function(data) {
        Wells.update(data.count);
      }, 'json');
    },

    update: function(val) {
      if (!val) {
        return $.getJSON('/count', function(data) {
          Wells.update(data.count);
        });
      }
      $('#wellscount').text(val);
    }
  };

$(document).ready(function() {
  Wells.init();
});

