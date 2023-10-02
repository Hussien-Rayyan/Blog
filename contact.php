<?php
    include 'partials/header.php';
?>
    <section class="empty-page contact">
		<div class="container">
        <div class="form-title">
			<h2>Have you any question?</h2>
			<p>Lorem ipsum dolor sit amet,  ratione! Laboriosam est, assumenda. Perferendis, quo alias quaerat aliquid. Corporis ipsum minus voluptate? Dolore, esse natus!</p>
		</div>
		<div id="form_status"></div>
			<form type="POST" id="blog-contact" onSubmit="return valid_datas( this );">
					<input type="text" placeholder="Name" name="name" id="name" class="col-md">
					<input type="email" placeholder="Email" name="email" id="email" class="col-md">
					<input type="tel" placeholder="Phone" name="phone" id="phone">
                    <textarea name="message" id="message" cols="15" rows="5" placeholder="Message"></textarea></p>
					<input type="hidden" name="token" value="FsWga4&@f6aw" />
                        <input type="submit" value="Submit">
			</form>
        </div>
		</div>
    </section>
	<?php
    include 'partials/footer.php';
?>