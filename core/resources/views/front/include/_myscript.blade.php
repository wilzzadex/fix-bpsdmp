<script>
		function myBlock()
		{
			$('#berita_render').block({
				message: '<img width="30%" src="{{ asset("gif/13.gif") }}" />', 
				css: {
					backgroundColor: 'transparent',
					border: '0'
					}
			
			});
		}
		function myBlock2()
		{
			$.blockUI({
				message: '<img width="30%" src="{{ asset("gif/13.gif") }}" />', 
				css: {
					backgroundColor: 'transparent',
					border: '0'
					}
			
			});
		}

		function formatTanggal(tanggal)
		{
			const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
				"Juli", "Agustus", "September", "Oktober", "November", "Desember"];
			let dateObj = new Date(tanggal);
			let month = monthNames[dateObj.getMonth()];
			let day = String(dateObj.getDate()).padStart(2, '0');
			let year = dateObj.getFullYear();
			let output = day + ' ' + month  + ' ' + year;
			return output;
		}
	
    $(document).ready(function () {
        $( window ).on("load", function() {
            $(".bs-example-modal-lg2").modal('show');
            setTimeout(function () {
                $(".bs-example-modal-lg2").modal('hide');
            },  5000);
        });

		
        

		$('#datatable1').dataTable({
			rowReorder: {
				selector: 'td:nth-child(2)'
			},
			responsive: true
		});
		
			
		const options = {
			// range_select: true,
			multi_select: true,
			future_select: true,
			past_select: true,
			frozen: true,
			selected:['2020-08-30']
		}

		// var arrDate = [];
		var listDate = []
		$.ajax({
			url : '{{ route("get.Date") }}',
			type: 'get',
			success:function(res){
				if(res.length != 0){
					Kalender(res)
				}else{
					Kalender(res)
				}
			}
		})

		// console.log(arrDate)
		
	

		function Kalender(data){
			const calendar_el = document.querySelector('#my-calendar');

			const my_calendar = new TavoCalendar(calendar_el, {
				highlight_sunday: false,
				
				highlight: data,
				// multi_select: true,
				past_select: true,
			})

			calendar_el.addEventListener('calendar-select', (ev) => {
				var _tanggalSelect = my_calendar.getSelected()
				$.ajax({
					url : '{{ route("get.event") }}',
					type: 'get',
					data: {
						tanggal:_tanggalSelect
					},
					beforeSend: function(){
						myBlock2()
					},
					success:function(res){
						$.unblockUI()
						// console.log(res)
						if(res.length == 0){
							$('.modal-title').html('Kegiatan tanggal '+formatTanggal(_tanggalSelect))
							$('.isi-modal').html('<center><h3>Tidak Ada kegiatan di tanggal Ini</h3></center>')
							$('#myModal').modal('show')
						}else{
							var _isiModal = ''
							
							// console.log(base)
							$.each(res,function(key,row){
								var url = '{{ route("publikasi.event.detail", ":id") }}';
								url = url.replace(':id', row.slug);
								_isiModal += `
												<li><a href="`+url+`">`+row.judul_id+`</a></li>
												<li><i class="icon-calendar3"></i> `+formatTanggal(row.tanggal_awal)+` s/d `+formatTanggal(row.tanggal_akhir)+`</li>
												<li>`+row.jam+`</li>
												<hr>
												`
							})
							$('.modal-title').html('Kegiatan tanggal '+formatTanggal(_tanggalSelect))
							$('.isi-modal').html(_isiModal)
							$('#myModal').modal('show')
						}
						
					}
				})
				// $('#myModal').modal('show')
			})

		}

        
       
        

    
    });


</script>
