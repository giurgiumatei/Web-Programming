$(document).ready(function() {


    var pre = $('pre');

    pre.dblclick(function(e) {
        var range = window.getSelection() || document.getSelection() || document.selection.createRange();
        var word = $.trim(range.toString());
        if(word !== '') {
            var sentences = document.querySelector('#sentences');
            var text = sentences.textContent;
            var regex = new RegExp('\\b('+word+')\\b', 'ig');
            text = text.replace(regex, '<span class="highlight">$1</span>');
            sentences.innerHTML = text;
        }

    });

});