<?php
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    function alert ($icon, $title, $text, $redirect) {
        if ($redirect != null) {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: '$icon',
                        title: '$title',
                        text: '$text',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location = '$redirect';
                    });
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: '$icon',
                        title: '$title',
                        text: '$text',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            </script>";
        }

        return;
    }

    function confirmation ($icon, $title, $text, $redirect) {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: '$icon',
                    title: '$title',
                    text: '$text',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Save',
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Saved!', '', 'success');
                        window.location = '$redirect';
                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info');
                    }
                });
            });
        </script>";

        return;
    }
?>