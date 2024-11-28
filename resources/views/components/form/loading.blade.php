<style>
    .loader-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.115);
        /* Background semi-transparent */
        z-index: 9999;
        /* Agar berada di atas semua elemen */
    }

    .loader {
        border: 16px solid #f3f3f3;
        border-top: 16px solid #ff6c0a;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .myhidden {
        display: none;
    }
</style>

<div id="loader-container" class="loader-container myhidden">
    <div class="loader"></div><br />
</div>

<script>
    function showLoading() {
        $('#loader-container').removeClass('myhidden').show();
    }

    function hideLoading() {
        $('#loader-container').hide().addClass('myhidden');
    }
</script>
