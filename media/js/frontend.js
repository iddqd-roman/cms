$(function(){
    $('.cmscms-edit').each(function(i, element){
        var $this = $(element);
        $this.append('<a href="'+$this.data('edit')+'" class="cmscms-goedit" style="width: '+$this.width()+'px; height: '+$this.height()+'px;" target="_blank"></a>');
    });
    $('#cms-navbar input').switcher({copy: {en: {yes: '', no: ''}}}).on('change', function(){
        var checkbox = $(this);
        checkbox.switcher('setDisabled', true);
        location.href = checkbox.attr('data-link') + '/' + (checkbox.is(':checked') ? 1 : 0);
    });
    $('#cms-navbar .live-edit-label').on('click', function(){
        $('#cms-navbar .switcher').trigger('click');
    });
});