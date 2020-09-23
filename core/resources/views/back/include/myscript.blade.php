<script>
  

    function myBlock()
    {
        $.blockUI({
            message: '<img width="30%" src="{{ asset("gif/13.gif") }}" />', 
            css: {
                backgroundColor: 'transparent',
                border: '0'
                }
          
        });
    }

    function logout()
    {
        document.location.href = '{{ route("logout") }}'
    }
    
    $(document).ready(function(){

        Main.init();
        // Index.init();

        $('#sample_1').dataTable({
            "language": {
                "sSearch": "Cari",
                "lengthMenu": "Menampilkan _MENU_ baris",
                "zeroRecords": "Nothing found - sorry",
                "info": "Manampilkan Halaman _PAGE_ dari _PAGES_ Halaman",
                "infoEmpty": "Tidak Ditemukan Data",
                "infoFiltered": "(Terfilter dari _MAX_ total Baris)",
                "oPaginate": {
                    "sFirst" : "Pertama"
                }
            }
        });
        
        $('#date-picker').datepicker({
            format:"dd MM yyyy"
        });
        
        $("#input-simple").fileinput(), $("#input-preview").fileinput();
        $("#mediaInfo").fileinput({
            overwriteInitial: !0,
            maxFileSize: 2e3,
            showClose: !1,
            showCaption: !1,
            browseLabel: "",
            removeLabel: "",
            browseIcon: '<i class="glyphicon glyphicon-picture"></i> Pilih Gambar',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: "Cancel or reset changes",
            elErrorContainer: "#kv-avatar-errors",
            msgErrorClass: "alert alert-block alert-danger",
            defaultPreviewContent: '<img src="http://www.placehold.it/160x160/EFEFEF/AAAAAA?text=no+image" alt="Your Avatar" >',
            layoutTemplates: {
                main2: "{preview} {remove} {browse}"
            },
            allowedFileExtensions: ["jpg", "png", "gif"]
        })
       
       


        
        
    })
    


    // CKEDITOR.replace( 'editor1' );
        // CKEDITOR.replace( 'editor2' );
</script>