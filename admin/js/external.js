/**
 * External JavaScript functions for CMS Van Hiep
 */

// Format currency
function formatCurrency(number) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
}

// Format date
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('vi-VN');
}

// Confirm delete
function confirmDelete(message) {
    if (!message) {
        message = 'Bạn có chắc chắn muốn xóa không?';
    }
    return confirm(message);
}

// Check all checkboxes
function checkAll(source, name) {
    const checkboxes = document.getElementsByName(name);
    for (let i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = source.checked;
    }
}

// Get selected IDs
function getSelectedIds(name) {
    const checkboxes = document.getElementsByName(name);
    const ids = [];
    for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            ids.push(checkboxes[i].value);
        }
    }
    return ids;
}

// Delete selected items
function deleteSelected(name, action) {
    const ids = getSelectedIds(name);
    if (ids.length === 0) {
        alert('Vui lòng chọn ít nhất một mục để xóa!');
        return false;
    }
    
    if (confirmDelete()) {
        document.getElementById('form-action').action = action;
        document.getElementById('form-action').submit();
        return true;
    }
    
    return false;
} 