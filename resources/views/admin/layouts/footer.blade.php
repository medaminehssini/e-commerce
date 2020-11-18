    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">

    </footer>
    <!-- END: Footer-->

<script>
  $( "#edit" ).submit(function(e) {
        e.preventDefault();
        editForm = document.getElementById('edit');
        document.getElementById("errorContent").innerHTML ="";
        var sendData = $( this ).serialize();
        document.getElementById('loadingData').style.display ="block";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': editForm._token.value
            }
        });
        var formData = new FormData($(this)[0]);
        console.log(formData);
        $.ajax({
            type:"POST",
            url: editForm.action,
            data: formData ,
            contentType: false,
        processData: false,
            dataType: "json",
            success: function(data){
                dataThumbView.ajax.reload();
                document.getElementById('loadingData').style.display ="none";
                toastr.success(data.success, { positionClass: 'toast-top-right', containerId: 'toast-top-right' });
                document.getElementsByClassName('cancel-data-btn')[0].click();
            },
            error: function(errMsg) {
                console.log(errMsg);
                message = '<div class="alert alert-danger">';
                errMsg.responseJSON.forEach(element => {
                    message += '<li>'+element+'</li>'
                });
                message += '</div>';
                document.getElementById("errorContent").innerHTML = message ;
                message = '';
                document.getElementById('loadingData').style.display ="none";

            }
        });
    });

</script>
</body>
<!-- END: Body-->

</html>
