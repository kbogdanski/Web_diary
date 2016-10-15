
$(document).ready(function(){
    
    var addRate = $('.addRate');
    var addRateForm = $('.addRateForm');
    
    //wyświetlanie formularza do dodawania ocen
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
    
    
    addRateForm.on('submit', function(event) {
        
        event.preventDefault();
        var newRate = $(event.target).children().eq(0).val();
        var newDescription = $(event.target).children().eq(1).val();
        var id = $(event.target).attr('data-id');
        
        
        
        $.ajax({
            url: addRateForm.attr('action'),
            method: "POST",
            data: {rate: newRate, description: newDescription, id: id}
        })
                .done(function (data) {
                    //to co ma zrobić po zapisaniu do DB
                    $(event.target).children().eq(0).val('');
                    $(event.target).children().eq(1).val('');
                    $(event.target).parent().css('display', 'none');
                    $(event.target).parent().prev().children().eq(0).text('Wstaw ocene');
                    console.log(data);
                })
                .fail(function () {
                    //to co ma zrobić gdy zapisanie do DB się nie uda
                })

                .always(function () {
                    //to co ma zarobić zawsze
                });
        
        console.log('kliknałes');
    });
    

    
});

