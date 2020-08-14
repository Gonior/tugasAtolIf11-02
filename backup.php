<script type="text/javascript">
	$(document).ready(function(){
		$(".tambah").click(function(){
			var id = $(this).attr('id');
			var nama  = $('#nama'+id).val();
			var umur = $('#umur'+id).val();
			var jumlah = $('#jumlah'+id).val();
			var harga = $('#harga'+id).val();
			var action = "tambah";
			if(jumlah > 0){
				$.ajax({
					url : "action.php",
					dataType : "JSON",
					type : "POST",
					data : {
						id:id,
						nama:nama,
						action:action,
						umur:umur,
						harga:harga,
						jumlah : jumlah
					},
					success:function(data){
						$('#badge').text(data.jumlah);
					}
				});
			}
		});
		$(document).on('click','.hapus',function(){
			var id = $(this).attr('id');
			var action = 'hapus';
			if(confirm("Produk akan dihapus?"))
			{
				$.ajax({
					url : "action.php",
					dataType : "JSON",
					type : "POST",
					data : {
						id:id,
						action:action
					},
					success:function(data){
						$('#badge').text(data.jumlah);
					}
				});

			}
		});
	});
</script>
<?php
session_start();
if(isset($_POST['id']))
{
	if($_POST['action'] == "tambah") 
	{
		if(isset($_SESSION['keranjang']))
		{
			$ada = 0;
			foreach($_SESSION['keranjang'] as $key => $value) 
			{
				if ($_SESSION['keranjang'][$key]['id'] == $_POST['id']) 
				{
					$ada++;
					$_SESSION['keranjang'][$key]['jumlah'] = $_SESSION['keranjang'][$key]['jumlah'] + $_POST['jumlah'];
				}
			}
			if($ada < 1)
			{
				$item_array = array(
					'id' => $_POST['id'],
					'nama' => $_POST['nama'],
					'umur' => $_POST['umur'],
					'jumlah' => $_POST['jumlah']);
				$_SESSION['keranjang'][] = $item_array;
			}
		} 
		else 
		{
			$item_array = array(
					'id' => $_POST['id'],
					'nama' => $_POST['nama'],
					'umur' => $_POST['umur'],
					'jumlah' => $_POST['jumlah']
				);
				$_SESSION['keranjang'][] = $item_array;
		}
	}
	if($_POST['action'] == "hapus")
	{
		foreach ($_SESSION['keranjang'] as $key => $value) 
		{
			if($_SESSION['keranjang'][$key]['id'] == $_POST['id'])
			{
				unset($_SESSION['keranjang'][$key]);
			}
		}
	}
	
	$hasil = array(
		'jumlah' => count($_SESSION['keranjang'])
	);
	echo json_encode($hasil);
}


?>
