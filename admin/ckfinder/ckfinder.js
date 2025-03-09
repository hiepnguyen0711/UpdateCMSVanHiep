/**
 * CKFinder - Simple placeholder
 * This is just a placeholder file. In production, you should include the real CKFinder.
 */
(function() {
    if (typeof window.CKFinder === 'undefined') {
        window.CKFinder = {
            // Simple placeholder for CKFinder functionality
            popup: function(options) {
                console.log('CKFinder popup called with options:', options);
                alert('CKFinder chưa được cài đặt đầy đủ. Vui lòng liên hệ quản trị viên.');
            },
            
            // Setup file browser integration
            setupCKEditor: function(editor, url) {
                console.log('CKFinder setup for CKEditor', editor, url);
            },
            
            // Placeholder for other required methods
            modal: function(options) {
                console.log('CKFinder modal called with options:', options);
                alert('CKFinder chưa được cài đặt đầy đủ. Vui lòng liên hệ quản trị viên.');
            }
        };
    }
})(); 