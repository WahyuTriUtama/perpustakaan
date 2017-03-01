$.fn.capitalize = function() {
    return this.each(function() {
        var $field = $(this);
 
        $field.on('keyup change', function() {
            $field.val(function(i, old) {
                if (old.indexOf(' ') > -1) {
                    var words = old.split(' ');
                    for (i = 0; i < words.length; i++) {
                        words[i] = caps(words[i]);
                    }
                    return words.join(' ');
                } else {
                    return caps(old);
                }
            });
        });
    });
 
    function caps(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    }
};