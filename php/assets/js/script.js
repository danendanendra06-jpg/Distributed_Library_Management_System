/**
 * Global JavaScript helper functions
 */

// Format currency IDR
function formatRupiah(angka, prefix) {
    var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

// Helper to show alerts
function showAlert(message, type = 'success') {
    const div = document.createElement('div');
    div.className = `btn btn-${type}`;
    div.style.position = 'fixed';
    div.style.top = '20px';
    div.style.right = '20px';
    div.style.zIndex = '1000';
    div.style.width = 'auto'; // ensure width fits content
    div.style.padding = "10px 20px"
    div.textContent = message;

    document.body.appendChild(div);

    setTimeout(() => {
        div.remove();
    }, 3000);
}

// API Helper
async function fetchAPI(endpoint, method = 'GET', data = null) {
    const options = {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            // Add JWT token if available
        }
    };

    // Inject Token
    if (typeof USER_TOKEN !== 'undefined' && USER_TOKEN) {
        options.headers['Authorization'] = 'Bearer ' + USER_TOKEN;
    }

    if (data) {
        options.body = JSON.stringify(data);
    }

    try {
        const response = await fetch(`${API_BASE_URL}${endpoint}`, options);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        // Handle void responses (like DELETE) that might not return JSON
        const text = await response.text();
        return text ? JSON.parse(text) : {};
    } catch (error) {
        console.error('API Error:', error);
        showAlert('Terjadi kesalahan koneksi ke server.', 'danger');
        return null;
    }
}
