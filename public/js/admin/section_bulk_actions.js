function section_action(type) {
    if (type != 'export' && $('.check').filter(':checked').length == 0) {
        alert('Please select the section to ' + type);
        return false;
    }
    if (confirm('Are you sure want to ' + type + '?')) {
        $('#action_type').val(type);
        $('#section_form').submit();
    }
}