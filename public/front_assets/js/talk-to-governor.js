document.addEventListener('DOMContentLoaded', function () {
    // 1. Character Counter
    const messageInput = document.getElementById('govMessage');
    const charCounter = document.getElementById('govCharCounter');

    if (messageInput && charCounter) {
        const updateCount = () => {
            charCounter.textContent = messageInput.value.length;
        };
        messageInput.addEventListener('input', updateCount);
        updateCount(); // Initial count
    }

    // Helper format bytes
    const formatBytes = (bytes) => {
        if (!bytes || bytes === 0) return '0 B';
        const k = 1024;
        const sizes = ['B', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
    };

    // 2. PDF Document Upload
    const docCard = document.getElementById('govDocUploadCard');
    const docInput = document.getElementById('govDocumentInput');
    const docTitle = document.getElementById('govDocTitle');
    const docSub = document.getElementById('govDocSub');
    const docClear = document.getElementById('govDocClear');

    if (docCard && docInput) {
        docCard.addEventListener('click', function (e) {
            if (e.target === docClear || docClear.contains(e.target)) return;
            docInput.click();
        });

        docInput.addEventListener('change', function () {
            if (docInput.files && docInput.files[0]) {
                const file = docInput.files[0];
                if (file.type !== 'application/pdf' && !file.name.toLowerCase().endsWith('.pdf')) {
                    alert('Please select a valid PDF file.');
                    docInput.value = '';
                    return;
                }
                if (file.size > 10 * 1024 * 1024) {
                    alert('PDF file size must not exceed 10 MB.');
                    docInput.value = '';
                    return;
                }
                docTitle.textContent = file.name;
                docSub.textContent = formatBytes(file.size) + ' • PDF Document';
                docClear.classList.remove('d-none');
            }
        });

        if (docClear) {
            docClear.addEventListener('click', function (e) {
                e.stopPropagation();
                docInput.value = '';
                docTitle.textContent = 'Choose a PDF or drop it here';
                docSub.textContent = 'One file, up to 10 MB';
                docClear.classList.add('d-none');
            });
        }

        // Drag and drop for PDF
        ['dragenter', 'dragover'].forEach(eventName => {
            docCard.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
                docCard.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            docCard.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
                docCard.classList.remove('dragover');
            });
        });

        docCard.addEventListener('drop', function (e) {
            const dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length > 0) {
                const file = dt.files[0];
                if (file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf')) {
                    docInput.files = dt.files;
                    const event = new Event('change');
                    docInput.dispatchEvent(event);
                } else {
                    alert('Please drop a valid PDF file.');
                }
            }
        });
    }

    // 3. Images Upload
    const imgCard = document.getElementById('govImagesUploadCard');
    const imgInput = document.getElementById('govImagesInput');
    const imgTitle = document.getElementById('govImagesTitle');
    const imgSub = document.getElementById('govImagesSub');
    const imgClear = document.getElementById('govImagesClear');

    if (imgCard && imgInput) {
        imgCard.addEventListener('click', function (e) {
            if (e.target === imgClear || imgClear.contains(e.target)) return;
            imgInput.click();
        });

        imgInput.addEventListener('change', function () {
            if (imgInput.files && imgInput.files.length > 0) {
                if (imgInput.files.length > 3) {
                    alert('You can select a maximum of 3 images.');
                    imgInput.value = '';
                    return;
                }

                let totalSize = 0;
                let names = [];
                for (let i = 0; i < imgInput.files.length; i++) {
                    const f = imgInput.files[i];
                    if (!f.type.startsWith('image/')) {
                        alert('Only image files (JPG, PNG) are allowed.');
                        imgInput.value = '';
                        return;
                    }
                    if (f.size > 5 * 1024 * 1024) {
                        alert(`Image "${f.name}" exceeds the 5 MB limit.`);
                        imgInput.value = '';
                        return;
                    }
                    totalSize += f.size;
                    names.push(f.name);
                }

                if (imgInput.files.length === 1) {
                    imgTitle.textContent = names[0];
                } else {
                    imgTitle.textContent = `${imgInput.files.length} images selected`;
                }
                imgSub.textContent = formatBytes(totalSize) + ' total • JPG/PNG';
                imgClear.classList.remove('d-none');
            }
        });

        if (imgClear) {
            imgClear.addEventListener('click', function (e) {
                e.stopPropagation();
                imgInput.value = '';
                imgTitle.textContent = 'Choose images or drop them here';
                imgSub.textContent = 'Up to 3 files, JPG or PNG, 5 MB each';
                imgClear.classList.add('d-none');
            });
        }

        // Drag and drop for Images
        ['dragenter', 'dragover'].forEach(eventName => {
            imgCard.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
                imgCard.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            imgCard.addEventListener(eventName, function (e) {
                e.preventDefault();
                e.stopPropagation();
                imgCard.classList.remove('dragover');
            });
        });

        imgCard.addEventListener('drop', function (e) {
            const dt = e.dataTransfer;
            if (dt && dt.files && dt.files.length > 0) {
                if (dt.files.length > 3) {
                    alert('You can only drop up to 3 images.');
                    return;
                }
                imgInput.files = dt.files;
                const event = new Event('change');
                imgInput.dispatchEvent(event);
            }
        });
    }
});

