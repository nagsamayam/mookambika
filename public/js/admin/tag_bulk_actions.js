function tag_action(type) {
    if (type != 'export' && $('.check').filter(':checked').length == 0) {
        alert('Please select the tag to ' + type);
        return false;
    }
    if (confirm('Are you sure want to ' + type + '?')) {
        $('#action_type').val(type);
        $('#tag_form').submit();
    }
}