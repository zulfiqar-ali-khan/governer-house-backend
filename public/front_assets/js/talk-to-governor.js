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

    // 4. reCAPTCHA Client-side Validation & Callbacks
    window.govRecaptchaSuccessCallback = function () {
        const err = document.getElementById('govRecaptchaClientError');
        if (err) err.classList.add('d-none');
    };

    window.govRecaptchaExpiredCallback = function () {
        const err = document.getElementById('govRecaptchaClientError');
        if (err) {
            err.textContent = 'reCAPTCHA verification expired. Please check the box again.';
            err.classList.remove('d-none');
        }
    };

    const govForm = document.getElementById('govContactForm');
    if (govForm) {
        govForm.addEventListener('submit', function (e) {
            if (typeof grecaptcha !== 'undefined') {
                const response = grecaptcha.getResponse();
                if (!response || response.trim().length === 0) {
                    e.preventDefault();
                    const err = document.getElementById('govRecaptchaClientError');
                    if (err) {
                        err.textContent = 'Please complete the reCAPTCHA verification.';
                        err.classList.remove('d-none');
                    }
                    const recaptchaEl = document.querySelector('.gov-recaptcha-section');
                    if (recaptchaEl && typeof recaptchaEl.scrollIntoView === 'function') {
                        recaptchaEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return false;
                }
            }
        });
    }

    // 5. Input Masking (CNIC & Mobile Number)
    const cnicInput = document.getElementById('govCnic');
    const mobileInput = document.getElementById('govMobileNumber');

    // CNIC Formatter: XXXXX-XXXXXXX-X (13 digits -> 15 chars)
    function formatCNIC(val) {
        if (!val) return '';
        const digits = val.replace(/\D/g, '').slice(0, 13);
        if (digits.length <= 5) return digits;
        if (digits.length <= 12) return digits.slice(0, 5) + '-' + digits.slice(5);
        return digits.slice(0, 5) + '-' + digits.slice(5, 12) + '-' + digits.slice(12, 13);
    }

    // Mobile Number Formatter: 03XX-XXXXXXX or +92 3XX XXXXXXX
    function formatMobile(val) {
        if (!val) return '';
        val = val.trim();
        const hasPlus = val.startsWith('+');
        let digits = val.replace(/\D/g, '');

        // If starts with + or 92 (e.g. +923001234567 or 923001234567)
        if (hasPlus || (digits.startsWith('92') && (digits.length >= 11 || val.startsWith('92')))) {
            let clean = digits;
            if (clean.startsWith('92')) clean = clean.slice(2);
            clean = clean.slice(0, 10);
            if (clean.length === 0) return '+92 ';
            if (clean.length <= 3) return '+92 ' + clean;
            return '+92 ' + clean.slice(0, 3) + ' ' + clean.slice(3, 10);
        }

        // Auto-prepend 0 if 10 digits entered starting with 3 (e.g. 3001234567 -> 0300-1234567)
        if (digits.length === 10 && digits.startsWith('3')) {
            digits = '0' + digits;
        }

        const d = digits.slice(0, 11);
        if (d.length <= 4) return d;
        return d.slice(0, 4) + '-' + d.slice(4, 11);
    }

    // Helper to apply masking while preserving cursor position accurately
    function applyMaskWithCursor(input, formatter) {
        const oldVal = input.value;
        const oldCursor = input.selectionEnd || 0;

        // Count how many significant chars (digits or +) were before cursor
        const charsBeforeCursor = oldVal.slice(0, oldCursor).replace(/[^\d+]/g, '').length;

        const newVal = formatter(oldVal);
        input.value = newVal;

        // Calculate new cursor position matching significant chars
        let newCursor = 0;
        let charsFound = 0;
        for (let i = 0; i < newVal.length; i++) {
            if (/[\d+]/.test(newVal[i])) {
                charsFound++;
            }
            if (charsFound === charsBeforeCursor) {
                newCursor = i + 1;
                break;
            }
        }

        if (charsBeforeCursor === 0) {
            newCursor = 0;
        } else if (charsFound < charsBeforeCursor) {
            newCursor = newVal.length;
        }

        input.setSelectionRange(newCursor, newCursor);
    }

    function setupMaskedInput(input, formatter) {
        if (!input) return;

        // Initial format on load if value exists
        if (input.value) {
            input.value = formatter(input.value);
        }

        // Keydown handling for seamless Backspace and Delete over separators (- or space)
        input.addEventListener('keydown', function (e) {
            if (e.key === 'Backspace' && !e.ctrlKey && !e.metaKey && !e.altKey) {
                const start = input.selectionStart;
                const end = input.selectionEnd;
                if (start === end && start > 0) {
                    const charBefore = input.value[start - 1];
                    if (charBefore === '-' || charBefore === ' ') {
                        e.preventDefault();
                        const val = input.value;
                        // Remove separator AND the digit before it
                        input.value = val.slice(0, Math.max(0, start - 2)) + val.slice(start);
                        const newPos = Math.max(0, start - 2);
                        input.setSelectionRange(newPos, newPos);
                        input.dispatchEvent(new Event('input'));
                    }
                }
            } else if (e.key === 'Delete' && !e.ctrlKey && !e.metaKey && !e.altKey) {
                const start = input.selectionStart;
                const end = input.selectionEnd;
                if (start === end && start < input.value.length) {
                    const charAfter = input.value[start];
                    if (charAfter === '-' || charAfter === ' ') {
                        e.preventDefault();
                        const val = input.value;
                        // Remove separator AND the digit after it
                        input.value = val.slice(0, start) + val.slice(start + 2);
                        input.setSelectionRange(start, start);
                        input.dispatchEvent(new Event('input'));
                    }
                }
            }
        });

        // Input event (handles typing, pasting, mobile virtual keypad, autofill)
        input.addEventListener('input', function () {
            applyMaskWithCursor(input, formatter);
        });

        // Blur event (final cleanup)
        input.addEventListener('blur', function () {
            input.value = formatter(input.value);
        });
    }

    setupMaskedInput(cnicInput, formatCNIC);
    setupMaskedInput(mobileInput, formatMobile);
});

