<!DOCTYPE html>
<html>

<head>
	<title>Nhập dữ liệu sản phẩm</title>
	<link rel="stylesheet" href="css/style_sp.css">
</head>

<body>
	<div id="contain">
		<form action="./xuly_them_sp.php" method="POST" enctype="multipart/form-data">
			<div class="full"></div>
			<div class="item">
				<label for="name">Tên sản phẩm</label>
				<br>
				<input type="text" name="name" id="name" size="30" placeholder=" name">

				<br>
				<input type="price" name="price" id="price" size="30" placeholder="price">
				<label for="summary">Mô tả</label>
				<br>
				<textarea name="summary" id="summary" cols="30" rows="5"></textarea>

				<div class="item-img">
					<label for="image">Ảnh</label>
					<input type="file" name="image" id="image" size="30">
				</div>
				<div class="id-dm">
					<div class=item-madm>
						<label for="type">Mã danh mục</label>
						<?php
						$cn = mysqli_connect('localhost', 'root', '', 'shop_db');
						if (!$cn) {
							die("Kết nối mysql không thành công,vui lòng kiểm tra lại server");
						}
						$sql = "SELECT * FROM type ";
						$kq = mysqli_query($cn, $sql);
						$n = mysqli_num_rows($kq);
						?>
						<div class="custom">
							<div class="custom-select">
								<select name="type" id="type">
									<?php
									while ($dm = mysqli_fetch_object($kq)) {
										echo "	<option value='$dm->id_b'>$dm->book_type </option>";
									}
									?>
								</select>
							</div>
						</div>

					</div>

				</div>
				<script src="css/cs.js"></script>
				<div class="button">
					<input type="submit" name="btn_gui" value="Save" id="save">
					<input type="reset" name="btn_xoa" value="Cancel" id="reset">
				</div>
			</div>
		</form>
	</div>
</body>

</html>