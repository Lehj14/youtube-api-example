$(function(){
    $('.showData').on('click',function(){
        const id = this.id;
        $('#reveal_' + id).slideToggle('slow');
    });

    $('.close').on('click',function(){
        const id = this.id;
        $('#reveal_' + id).slideToggle('slow');
    });
});