
$(document).ready(function(){
    
    var addRate = $('.addRate');
    
    addRate.on('click', function(event) {
        console.log('dziala');
        if ($(event.target).text() === 'Wstaw ocene') {
            $(event.target).parent().next().css('display', 'block');
            $(event.target).text('Anuluj');
        } else {
            $(event.target).parent().next().css('display', 'none');
            $(event.target).text('Wstaw ocene');
        }
    });
    
    
});

