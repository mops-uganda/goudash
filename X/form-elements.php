<?php require_once("inc/init.php"); ?>
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			<i class="fa fa-edit fa-fw "></i> 
				Forms 
			<span>> 
				Form Elements
			</span>
		</h1>
	</div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		<ul id="sparks" class="">
			<li class="sparks-info">
				<h5> My Income <span class="txt-color-blue">$47,171</span></h5>
				<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
					1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
				</div>
			</li>
			<li class="sparks-info">
				<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
				<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
					110,150,300,130,400,240,220,310,220,300, 270, 210
				</div>
			</li>
			<li class="sparks-info">
				<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
				<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
					110,150,300,130,400,240,220,310,220,300, 270, 210
				</div>
			</li>
		</ul>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		
		<div class="well">
			<button class="close" data-dismiss="alert">
					×
			</button>
			<h1 class="semi-bold">What are "Smart Form Elements?"</h1>
		<p> 
			GOU Dashboard comes with a fully customized grid system catered specifically for building form layouts. Its not technically "better" than the bootstrap 3 built in grid system,
			but rather more simplified for rapid form layout and faster development. Idealy you would use either the <strong>bootstrap</strong> grid or the <strong>smart-form</strong> grid, 
			when building your form layouts. It is important not to mix elements from two seperate classes as it can cause conflict.  
		</p>
		
		<p>
			You can explore some of the <a href="#X/form-templates.html" title="Go to Bootstrap Forms">layouts</a> made using Smart Forms grid system or if you are not comfortable with this grid system you can simply stick to the default <a href="#X/bootstrap-forms.html" title="Go to Bootstrap Forms">Bootstrap forms</a>
		</p>
		</div>

		
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- START ROW -->
	<div class="row">

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-0" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Form Grid </h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">

						<form action="" class="smart-form">
							<header>
								Responsive grid system
							</header>

							<fieldset>
								<div class="row">
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
								</div>

								<div class="row">
									<section class="col col-3">
										<label class="input">
											<input type="text" placeholder="3/12">
										</label>
									</section>
									<section class="col col-3">
										<label class="input">
											<input type="text" placeholder="3/12">
										</label>
									</section>
									<section class="col col-3">
										<label class="input">
											<input type="text" placeholder="3/12">
										</label>
									</section>
									<section class="col col-3">
										<label class="input">
											<input type="text" placeholder="3/12">
										</label>
									</section>
								</div>

								<div class="row">
									<section class="col col-4">
										<label class="input">
											<input type="text" placeholder="4/12">
										</label>
									</section>
									<section class="col col-4">
										<label class="input">
											<input type="text" placeholder="4/12">
										</label>
									</section>
									<section class="col col-4">
										<label class="input">
											<input type="text" placeholder="4/12">
										</label>
									</section>
								</div>

								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="text" placeholder="6/12">
										</label>
									</section>
									<section class="col col-6">
										<label class="input">
											<input type="text" placeholder="6/12">
										</label>
									</section>
								</div>

								<section>
									<label class="input">
										<input type="text" placeholder="12/12">
									</label>
								</section>
							</fieldset>

							<fieldset>
								<div class="row">
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-3">
										<label class="input">
											<input type="text" placeholder="3/12">
										</label>
									</section>
									<section class="col col-3">
										<label class="input">
											<input type="text" placeholder="3/12">
										</label>
									</section>
								</div>

								<div class="row">
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-4">
										<label class="input">
											<input type="text" placeholder="4/12">
										</label>
									</section>
									<section class="col col-4">
										<label class="input">
											<input type="text" placeholder="4/12">
										</label>
									</section>
								</div>

								<div class="row">
									<section class="col col-2">
										<label class="input">
											<input type="text" placeholder="2/12">
										</label>
									</section>
									<section class="col col-4">
										<label class="input">
											<input type="text" placeholder="4/12">
										</label>
									</section>
									<section class="col col-6">
										<label class="input">
											<input type="text" placeholder="6/12">
										</label>
									</section>
								</div>
							</fieldset>

							<footer>
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
								<button type="button" class="btn btn-default" onclick="window.history.back();">
									Back
								</button>
							</footer>
						</form>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- END COL -->

	</div>

	<!-- END ROW -->

	<!-- START ROW -->

	<div class="row">

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Basic Form Elements </h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">

						<form action="" class="smart-form">
							<header>
								Standard Form Header
							</header>

							<fieldset>
								
								<section>
									<label class="label">Extra Small text input</label>
									<label class="input">
										<input type="text" class="input-xs">
									</label>
								</section>

								<section>
									<label class="label">Small text input</label>
									<label class="input">
										<input type="text" class="input-sm">
									</label>
								</section>

								<section>
									<label class="label">Default text input with maxlength</label>
									<label class="input">
										<input type="text" maxlength="10">
									</label>
									<div class="note">
										<strong>Maxlength</strong> is automatically added via the "maxlength='#'" attribute
									</div>
								</section>
																
								<section>
									<label class="label">Large text input</label>
									<label class="input">
										<input type="text" class="input-lg">
									</label>
								</section>
							
							</fieldset>
							
							<fieldset>
									
								<section>
									<label class="label">File input</label>
									<label for="file" class="input input-file">
										<div class="button"><input type="file" name="file" onchange="this.parentNode.nextSibling.value = this.value">Browse</div><input type="text" placeholder="Include some files" readonly="">
									</label>
								</section>

								<section>
									<label class="label">Input with autocomlete</label>
									<label class="input">
										<input type="text" list="list">
										<datalist id="list">
											<option value="Alexandra"></option>
											<option value="Alice"></option>
											<option value="Anastasia"></option>
											<option value="Avelina"></option>
											<option value="Basilia"></option>
											<option value="Beatrice"></option>
											<option value="Cassandra"></option>
											<option value="Cecil"></option>
											<option value="Clemencia"></option>
											<option value="Desiderata"></option>
											<option value="Dionisia"></option>
											<option value="Edith"></option>
											<option value="Eleanora"></option>
											<option value="Elizabeth"></option>
											<option value="Emma"></option>
											<option value="Felicia"></option>
											<option value="Florence"></option>
											<option value="Galiana"></option>
											<option value="Grecia"></option>
											<option value="Helen"></option>
											<option value="Helewisa"></option>
											<option value="Idonea"></option>
											<option value="Isabel"></option>
											<option value="Joan"></option>
											<option value="Juliana"></option>
											<option value="Karla"></option>
											<option value="Karyn"></option>
											<option value="Kate"></option>
											<option value="Lakisha"></option>
											<option value="Lana"></option>
											<option value="Laura"></option>
											<option value="Leona"></option>
											<option value="Mandy"></option>
											<option value="Margaret"></option>
											<option value="Maria"></option>
											<option value="Nanacy"></option>
											<option value="Nicole"></option>
											<option value="Olga"></option>
											<option value="Pamela"></option>
											<option value="Patricia"></option>
											<option value="Qiana"></option>
											<option value="Rachel"></option>
											<option value="Ramona"></option>
											<option value="Samantha"></option>
											<option value="Sandra"></option>
											<option value="Tanya"></option>
											<option value="Teresa"></option>
											<option value="Ursula"></option>
											<option value="Valerie"></option>
											<option value="Veronica"></option>
											<option value="Wilma"></option>
											<option value="Yasmin"></option>
											<option value="Zelma"></option>
										</datalist> </label>
									<div class="note">
										<strong>Note:</strong> works in Chrome, Firefox, Opera and IE10.
									</div>
								</section>
							</fieldset>

							<fieldset>
								
								<section>
									<label class="label">Select Small</label>
									<label class="select">
										<select class="input-sm">
											<option value="0">Choose name</option>
											<option value="1">Alexandra</option>
											<option value="2">Alice</option>
											<option value="3">Anastasia</option>
											<option value="4">Avelina</option>
										</select> <i></i> </label>
								</section>
								
								<section>
									<label class="label">Select default</label>
									<label class="select">
										<select>
											<option value="0">Choose name</option>
											<option value="1">Alexandra</option>
											<option value="2">Alice</option>
											<option value="3">Anastasia</option>
											<option value="4">Avelina</option>
										</select> <i></i> </label>
								</section>

								<section>
									<label class="label">Select Large</label>
									<label class="select">
										<select class="input-lg">
											<option value="0">Choose name</option>
											<option value="1">Alexandra</option>
											<option value="2">Alice</option>
											<option value="3">Anastasia</option>
											<option value="4">Avelina</option>
										</select> <i></i> </label>
								</section>

								<section>
									<label class="label">Multiple select</label>
									<label class="select select-multiple">
										<select multiple="" class="custom-scroll">
											<option value="1">Alexandra</option>
											<option value="2">Alice</option>
											<option value="3">Anastasia</option>
											<option value="4">Avelina</option>
											<option value="5">Basilia</option>
											<option value="6">Beatrice</option>
											<option value="7">Cassandra</option>
											<option value="8">Clemencia</option>
											<option value="9">Desiderata</option>
										</select> </label>
									<div class="note">
										<strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.
									</div>
								</section>
							</fieldset>

							<fieldset>
								<section>
									<label class="label">Textarea</label>
									<label class="textarea"> 										
										<textarea rows="3" class="custom-scroll"></textarea> 
									</label>
									<div class="note">
										<strong>Note:</strong> height of the textarea depends on the rows attribute.
									</div>
								</section>

								<section>
									<label class="label">Textarea resizable</label>
									<label class="textarea textarea-resizable"> 										
										<textarea rows="3" class="custom-scroll"></textarea> 
									</label>
								</section>

								<section>
									<label class="label">Textarea expandable</label>
									<label class="textarea textarea-expandable"> 										
										<textarea rows="3" class="custom-scroll"></textarea> 
									</label>
									<div class="note">
										<strong>Note:</strong> expands on focus.
									</div>
								</section>
							</fieldset>

							<fieldset>
								<section>
									<label class="label">Columned radios</label>
									<div class="row">
										<div class="col col-4">
											<label class="radio">
												<input type="radio" name="radio" checked="checked">
												<i></i>Alexandra</label>
											<label class="radio">
												<input type="radio" name="radio">
												<i></i>Alice</label>
											<label class="radio">
												<input type="radio" name="radio">
												<i></i>Anastasia</label>
										</div>
										<div class="col col-4">
											<label class="radio">
												<input type="radio" name="radio">
												<i></i>Avelina</label>
											<label class="radio">
												<input type="radio" name="radio">
												<i></i>Basilia</label>
											<label class="radio">
												<input type="radio" name="radio">
												<i></i>Beatrice</label>
										</div>
										<div class="col col-4">
											<label class="radio">
												<input type="radio" name="radio">
												<i></i>Cassandra</label>
											<label class="radio">
												<input type="radio" name="radio">
												<i></i>Clemencia</label>
											<label class="radio">
												<input type="radio" name="radio">
												<i></i>Desiderata</label>
										</div>
									</div>
								</section>

								<section>
									<label class="label">Inline radios</label>
									<div class="inline-group">
										<label class="radio">
											<input type="radio" name="radio-inline" checked="checked">
											<i></i>Alexandra</label>
										<label class="radio">
											<input type="radio" name="radio-inline">
											<i></i>Alice</label>
										<label class="radio">
											<input type="radio" name="radio-inline">
											<i></i>Anastasia</label>
										<label class="radio">
											<input type="radio" name="radio-inline">
											<i></i>Avelina</label>
										<label class="radio">
											<input type="radio" name="radio-inline">
											<i></i>Beatrice</label>
									</div>
								</section>
							</fieldset>

							<fieldset>
								<section>
									<label class="label">Columned checkboxes</label>
									<div class="row">
										<div class="col col-4">
											<label class="checkbox">
												<input type="checkbox" name="checkbox" checked="checked">
												<i></i>Alexandra</label>
											<label class="checkbox">
												<input type="checkbox" name="checkbox">
												<i></i>Alice</label>
											<label class="checkbox">
												<input type="checkbox" name="checkbox">
												<i></i>Anastasia</label>
										</div>
										<div class="col col-4">
											<label class="checkbox">
												<input type="checkbox" name="checkbox">
												<i></i>Avelina</label>
											<label class="checkbox">
												<input type="checkbox" name="checkbox">
												<i></i>Basilia</label>
											<label class="checkbox">
												<input type="checkbox" name="checkbox">
												<i></i>Beatrice</label>
										</div>
										<div class="col col-4">
											<label class="checkbox">
												<input type="checkbox" name="checkbox">
												<i></i>Cassandra</label>
											<label class="checkbox">
												<input type="checkbox" name="checkbox">
												<i></i>Clemencia</label>
											<label class="checkbox">
												<input type="checkbox" name="checkbox">
												<i></i>Desiderata</label>
										</div>
									</div>
								</section>

								<section>
									<label class="label">Inline checkboxes</label>
									<div class="inline-group">
										<label class="checkbox">
											<input type="checkbox" name="checkbox-inline" checked="checked">
											<i></i>Alexandra</label>
										<label class="checkbox">
											<input type="checkbox" name="checkbox-inline">
											<i></i>Alice</label>
										<label class="checkbox">
											<input type="checkbox" name="checkbox-inline">
											<i></i>Anastasia</label>
										<label class="checkbox">
											<input type="checkbox" name="checkbox-inline">
											<i></i>Avelina</label>
										<label class="checkbox">
											<input type="checkbox" name="checkbox-inline">
											<i></i>Beatrice</label>
									</div>
								</section>
							</fieldset>

							<fieldset>
								<div class="row">
									<section class="col col-5">
										<label class="label">Radio Toggles</label>
										<label class="toggle">
											<input type="radio" name="radio-toggle" checked="checked">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Alexandra</label>
										<label class="toggle">
											<input type="radio" name="radio-toggle">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Anastasia</label>
										<label class="toggle">
											<input type="radio" name="radio-toggle">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Avelina</label>
									</section>

									<div class="col col-2"></div>

									<section class="col col-5">
										<label class="label">Checkbox Toggles</label>
										<label class="toggle">
											<input type="checkbox" name="checkbox-toggle" checked="checked">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Cassandra</label>
										<label class="toggle">
											<input type="checkbox" name="checkbox-toggle">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Clemencia</label>
										<label class="toggle">
											<input type="checkbox" name="checkbox-toggle">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Desiderata</label>
									</section>
								</div>
							</fieldset>

							<fieldset>
								<section>
									<label class="label">Ratings with different icons</label>
									<div class="rating">
										<input type="radio" name="stars-rating" id="stars-rating-5">
										<label for="stars-rating-5"><i class="fa fa-star"></i></label>
										<input type="radio" name="stars-rating" id="stars-rating-4">
										<label for="stars-rating-4"><i class="fa fa-star"></i></label>
										<input type="radio" name="stars-rating" id="stars-rating-3">
										<label for="stars-rating-3"><i class="fa fa-star"></i></label>
										<input type="radio" name="stars-rating" id="stars-rating-2">
										<label for="stars-rating-2"><i class="fa fa-star"></i></label>
										<input type="radio" name="stars-rating" id="stars-rating-1">
										<label for="stars-rating-1"><i class="fa fa-star"></i></label>
										Stars
									</div>

									<div class="rating">
										<input type="radio" name="trophies-rating" id="trophies-rating-7">
										<label for="trophies-rating-7"><i class="fa fa-trophy"></i></label>
										<input type="radio" name="trophies-rating" id="trophies-rating-6">
										<label for="trophies-rating-6"><i class="fa fa-trophy"></i></label>
										<input type="radio" name="trophies-rating" id="trophies-rating-5">
										<label for="trophies-rating-5"><i class="fa fa-trophy"></i></label>
										<input type="radio" name="trophies-rating" id="trophies-rating-4">
										<label for="trophies-rating-4"><i class="fa fa-trophy"></i></label>
										<input type="radio" name="trophies-rating" id="trophies-rating-3">
										<label for="trophies-rating-3"><i class="fa fa-trophy"></i></label>
										<input type="radio" name="trophies-rating" id="trophies-rating-2">
										<label for="trophies-rating-2"><i class="fa fa-trophy"></i></label>
										<input type="radio" name="trophies-rating" id="trophies-rating-1">
										<label for="trophies-rating-1"><i class="fa fa-trophy"></i></label>
										Trophies
									</div>

									<div class="rating">
										<input type="radio" name="asterisks-rating" id="asterisks-rating-10">
										<label for="asterisks-rating-10"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-9">
										<label for="asterisks-rating-9"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-8">
										<label for="asterisks-rating-8"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-7">
										<label for="asterisks-rating-7"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-6">
										<label for="asterisks-rating-6"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-5">
										<label for="asterisks-rating-5"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-4">
										<label for="asterisks-rating-4"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-3">
										<label for="asterisks-rating-3"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-2">
										<label for="asterisks-rating-2"><i class="fa fa-asterisk"></i></label>
										<input type="radio" name="asterisks-rating" id="asterisks-rating-1">
										<label for="asterisks-rating-1"><i class="fa fa-asterisk"></i></label>
										Asterisks
									</div>
									<div class="note">
										<strong>Note:</strong> you can use more than 300 vector icons for rating.
									</div>
								</section>
							</fieldset>

							<footer>
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
								<button type="button" class="btn btn-default" onclick="window.history.back();">
									Back
								</button>
							</footer>
						</form>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- END COL -->

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-2" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Disabled States </h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">

						<form action="" class="smart-form">
							<header>
								Disabled States
							</header>

							<fieldset>
								
								<section>
									<label class="label">Extra Small text input</label>
									<label class="input state-disabled">
										<input type="text" class="input-xs" disabled="disabled">
									</label>
								</section>

								<section>
									<label class="label">Small text input</label>
									<label class="input state-disabled">
										<input type="text" class="input-sm" disabled="disabled">
									</label>
								</section>

								<section>
									<label class="label">Default text input with maxlength</label>
									<label class="input state-disabled">
										<input type="text" maxlength="10" disabled="disabled">
									</label>
									<div class="note">
										<strong>Maxlength</strong> is automatically added via the "maxlength='#'" attribute
									</div>
								</section>
																
								<section>
									<label class="label">Large text input</label>
									<label class="input state-disabled">
										<input type="text" class="input-lg" disabled="disabled">
									</label>
								</section>
							
							</fieldset>

							<fieldset>
								
								<section>
									<label class="label">File input (disabled)</label>
									<label for="file2" class="input input-file state-disabled">
										<div class="button disabled">
											Browse
										</div>
										<input type="text" disabled="disabled">
									</label>
								</section>

								<section>
									<label class="label">Input with autocomlete (disabled)</label>
									<label class="input state-disabled">
										<input type="text" list="list" disabled="disabled">
										<datalist id="list">
											<option value="Alexandra"></option>
											<option value="Alice"></option>
											<option value="Anastasia"></option>
											<option value="Avelina"></option>
											<option value="Basilia"></option>
											<option value="Beatrice"></option>
											<option value="Cassandra"></option>
											<option value="Cecil"></option>
											<option value="Clemencia"></option>
											<option value="Desiderata"></option>
											<option value="Dionisia"></option>
											<option value="Edith"></option>
											<option value="Eleanora"></option>
											<option value="Elizabeth"></option>
											<option value="Emma"></option>
											<option value="Felicia"></option>
											<option value="Florence"></option>
											<option value="Galiana"></option>
											<option value="Grecia"></option>
											<option value="Helen"></option>
											<option value="Helewisa"></option>
											<option value="Idonea"></option>
											<option value="Isabel"></option>
											<option value="Joan"></option>
											<option value="Juliana"></option>
											<option value="Karla"></option>
											<option value="Karyn"></option>
											<option value="Kate"></option>
											<option value="Lakisha"></option>
											<option value="Lana"></option>
											<option value="Laura"></option>
											<option value="Leona"></option>
											<option value="Mandy"></option>
											<option value="Margaret"></option>
											<option value="Maria"></option>
											<option value="Nanacy"></option>
											<option value="Nicole"></option>
											<option value="Olga"></option>
											<option value="Pamela"></option>
											<option value="Patricia"></option>
											<option value="Qiana"></option>
											<option value="Rachel"></option>
											<option value="Ramona"></option>
											<option value="Samantha"></option>
											<option value="Sandra"></option>
											<option value="Tanya"></option>
											<option value="Teresa"></option>
											<option value="Ursula"></option>
											<option value="Valerie"></option>
											<option value="Veronica"></option>
											<option value="Wilma"></option>
											<option value="Yasmin"></option>
											<option value="Zelma"></option>
										</datalist> </label>
									<div class="note">
										<strong>Note:</strong> works in Chrome, Firefox, Opera and IE10.
									</div>
								</section>
							</fieldset>

							<fieldset>
								<section>
									<label class="label">Select Small (disabled)</label>
									<label class="select state-disabled">
										<select class="input-sm" disabled="disabled">
											<option value="0">Choose name</option>
											<option value="1">Alexandra</option>
											<option value="2">Alice</option>
											<option value="3">Anastasia</option>
											<option value="4">Avelina</option>
										</select> <i></i> </label>
								</section>

								<section>
									<label class="label">Select Small (disabled)</label>
									<label class="select state-disabled">
										<select class="input-sm" disabled="disabled">
											<option value="0">Choose name</option>
											<option value="1">Alexandra</option>
											<option value="2">Alice</option>
											<option value="3">Anastasia</option>
											<option value="4">Avelina</option>
										</select> <i></i> </label>
								</section>
								
								<section>
									<label class="label">Select default (disabled)</label>
									<label class="select state-disabled">
										<select class="input-lg"  disabled="disabled">
											<option value="0">Choose name</option>
											<option value="1">Alexandra</option>
											<option value="2">Alice</option>
											<option value="3">Anastasia</option>
											<option value="4">Avelina</option>
										</select> <i></i> </label>
								</section>

								<section>
									<label class="label">Multiple select (disabled)</label>
									<label class="select select-multiple state-disabled">
										<select multiple="" class="custom-scroll" disabled="disabled">
											<option value="1">Alexandra</option>
											<option value="2">Alice</option>
											<option value="3">Anastasia</option>
											<option value="4">Avelina</option>
											<option value="5">Basilia</option>
											<option value="6">Beatrice</option>
											<option value="7">Cassandra</option>
											<option value="8">Clemencia</option>
											<option value="9">Desiderata</option>
										</select> </label>
									<div class="note">
										<strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.
									</div>
								</section>
							</fieldset>

							<fieldset>
								<section>
									<label class="label">Textarea (disabled)</label>
									<label class="textarea state-disabled"> 										<textarea rows="3" class="custom-scroll" disabled="disabled"></textarea> </label>
									<div class="note">
										<strong>Note:</strong> height of the textarea depends on the rows attribute.
									</div>
								</section>

								<section>
									<label class="label">Textarea resizable (disabled)</label>
									<label class="textarea textarea-resizable state-disabled"> 										<textarea rows="3" class="custom-scroll" disabled="disabled"></textarea> </label>
								</section>

								<section>
									<label class="label">Textarea expandable (disabled)</label>
									<label class="textarea textarea-expandable state-disabled"> 										<textarea rows="3" class="custom-scroll" disabled="disabled"></textarea> </label>
									<div class="note">
										<strong>Note:</strong> expands on focus.
									</div>
								</section>
							</fieldset>

							<fieldset>
								<section>
									<label class="label">Columned radios (disabled)</label>
									<div class="row">
										<div class="col col-4">
											<label class="radio state-disabled">
												<input type="radio" name="radio" checked="checked" disabled="disabled">
												<i></i>Alexandra</label>
											<label class="radio state-disabled">
												<input type="radio" name="radio" disabled="disabled">
												<i></i>Alice</label>
											<label class="radio state-disabled">
												<input type="radio" name="radio" disabled="disabled">
												<i></i>Anastasia</label>
										</div>
									</div>
								</section>

								<section>
									<label class="label">Inline radios (disabled)</label>
									<div class="inline-group">
										<label class="radio state-disabled">
											<input type="radio" name="radio-inline" checked="checked">
											<i></i>Alexandra</label>
										<label class="radio state-disabled">
											<input type="radio" name="radio-inline" disabled="disabled">
											<i></i>Alice</label>
										<label class="radio state-disabled">
											<input type="radio" name="radio-inline" disabled="disabled">
											<i></i>Anastasia</label>

									</div>
								</section>
							</fieldset>

							<fieldset>
								<section>
									<label class="label">Columned checkboxes (disabled)</label>
									<div class="row">
										<div class="col col-4">
											<label class="checkbox state-disabled">
												<input type="checkbox" name="checkbox" checked="checked" disabled="disabled">
												<i></i>Alexandra</label>
											<label class="checkbox state-disabled">
												<input type="checkbox" name="checkbox" disabled="disabled">
												<i></i>Alice</label>
											<label class="checkbox state-disabled">
												<input type="checkbox" name="checkbox" disabled="disabled">
												<i></i>Anastasia</label>
										</div>
									</div>
								</section>

								<section>
									<label class="label">Inline checkboxes (disabled)</label>
									<div class="inline-group">
										<label class="checkbox state-disabled">
											<input type="checkbox" name="checkbox-inline" checked="checked" disabled="disabled">
											<i></i>Alexandra</label>
										<label class="checkbox state-disabled">
											<input type="checkbox" name="checkbox-inline" disabled="disabled">
											<i></i>Alice</label>
										<label class="checkbox state-disabled">
											<input type="checkbox" name="checkbox-inline" disabled="disabled">
											<i></i>Anastasia</label>

									</div>
								</section>
							</fieldset>

							<fieldset>
								<div class="row">
									<section class="col col-5">
										<label class="label">Radio Toggles (disabled)</label>
										<label class="toggle state-disabled">
											<input type="radio" name="radio-toggle" checked="checked">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Alexandra</label>
										<label class="toggle state-disabled">
											<input type="radio" name="radio-toggle" disabled="disabled">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Anastasia</label>
										<label class="toggle state-disabled">
											<input type="radio" name="radio-toggle" disabled="disabled">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Avelina</label>
									</section>

									<div class="col col-2"></div>

									<section class="col col-5">
										<label class="label">Checkbox Toggles (disabled)</label>
										<label class="toggle state-disabled">
											<input type="checkbox" name="checkbox-toggle" checked="checked" disabled="disabled">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Cassandra</label>
										<label class="toggle state-disabled">
											<input type="checkbox" name="checkbox-toggle" disabled="disabled">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Clemencia</label>
										<label class="toggle state-disabled">
											<input type="checkbox" name="checkbox-toggle" disabled="disabled">
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i>Desiderata</label>
									</section>
								</div>
							</fieldset>

							<footer>
								<button type="submit" class="btn btn-primary">
									Submit
								</button>
								<button type="button" class="btn btn-default" onclick="window.history.back();">
									Back
								</button>
							</footer>
						</form>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- END COL -->

	</div>

	<!-- END ROW -->

	<!-- NEW ROW -->

	<div class="row">


		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Smart Tooltips (left) </h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">

						<form action="" class="smart-form">
							<header>
								Tooltips (with icon)
							</header>

							<fieldset>
								<section>
									<label class="label">Text input with top-right tooltip</label>
									<label class="input"> <i class="icon-append fa fa-question-circle"></i>
										<input type="text" placeholder="Focus to view the tooltip">
										<b class="tooltip tooltip-top-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information</b> 
									</label>
								</section>

								<section>
									<label class="label">Text input with bottom-right tooltip</label>
									<label class="input"> <i class="icon-append fa fa-question-circle"></i>
										<input type="text" placeholder="Focus to view the tooltip">
										<b class="tooltip tooltip-bottom-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information</b> 
									</label>
								</section>

								<section>
									<label class="label">Text input with right tooltip</label>
									<label class="input"> <i class="icon-append fa fa-question-circle"></i>
										<input type="text" placeholder="Focus to view the tooltip">
										<b class="tooltip tooltip-right">
											<i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information</b> 
									</label>
								</section>

							</fieldset>

							<fieldset>
								<section>
									<label class="label">Textarea with top-right tooltip</label>
									<label class="textarea"> <i class="icon-append fa fa-question-circle"></i> 										
										<textarea rows="3" placeholder="Focus to view the tooltip"></textarea>
										<b class="tooltip tooltip-top-right"> 
											<i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information </b> 
									</label>
								</section>

								<section>
									<label class="label">Textarea with bottom-right tooltip</label>
									<label class="textarea"> <i class="icon-append fa fa-question-circle"></i> 										
										<textarea rows="3" placeholder="Focus to view the tooltip"></textarea> 
										<b class="tooltip tooltip-bottom-right"><i class="fa fa-warning txt-color-teal"></i> Some helpful information</b> 
									</label>
								</section>

								<section>
									<label class="label">Textarea with right tooltip</label>
									<label class="textarea"> <i class="icon-append fa fa-question-circle"></i> 										
										<textarea rows="3" placeholder="Focus to view the tooltip"></textarea> 
										<b class="tooltip tooltip-right"><i class="fa fa-warning txt-color-teal"></i> Some helpful information</b> 
									</label>
								</section>

							</fieldset>

						</form>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- END COL -->

		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-4" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
				<!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>Smart Tooltips (right) </h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body no-padding">

						<form action="" class="smart-form">
							<header>
								Tooltips (with icon)
							</header>

							<fieldset>

								<section>
									<label class="label">Text input with top-left tooltip</label>
									<label class="input"> <i class="icon-prepend fa fa-question-circle"></i>
										<input type="text" placeholder="Focus to view the tooltip">
										<b class="tooltip tooltip-top-left">
											<i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information</b> 
									</label>
								</section>

								<section>
									<label class="label">Text input with bottom-left tooltip</label>
									<label class="input"> <i class="icon-prepend fa fa-question-circle"></i>
										<input type="text" placeholder="Focus to view the tooltip">
										<b class="tooltip tooltip-bottom-left">
											<i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information</b> 
									</label>
								</section>

								<section>
									<label class="label">Text input with left tooltip</label>
									<label class="input"> <i class="icon-prepend fa fa-question-circle"></i>
										<input type="text" placeholder="Focus to view the tooltip">
										<b class="tooltip tooltip-left">
											<i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information</b> 
									</label>
								</section>
							</fieldset>

							<fieldset>

								<section>
									<label class="label">Textarea with top-left tooltip</label>
									<label class="textarea"> <i class="icon-prepend fa fa-question-circle"></i> 										
										<textarea rows="3" placeholder="Focus to view the tooltip"></textarea> 
										<b class="tooltip tooltip-top-left"> <i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information</b> 
									</label>
								</section>

								<section>
									<label class="label">Textarea with bottom-left tooltip</label>
									<label class="textarea"> <i class="icon-prepend fa fa-question-circle"></i> 										
										<textarea rows="3" placeholder="Focus to view the tooltip"></textarea> 
										<b class="tooltip tooltip-bottom-left"><i class="fa fa-warning txt-color-teal"></i> 
											Some helpful information</b> 
									</label>
								</section>


								<section>
									<label class="label">Textarea with left tooltip</label>
									<label class="textarea"> <i class="icon-prepend fa fa-question-circle"></i> 										
										<textarea rows="3" placeholder="Focus to view the tooltip"></textarea> <b class="tooltip tooltip-left">
											<i class="fa fa-warning txt-color-teal"></i> Some helpful information</b> 
									</label>
								</section>
							</fieldset>

						</form>

					</div>
					<!-- end widget content -->

				</div>
				<!-- end widget div -->

			</div>
			<!-- end widget -->

		</article>
		<!-- END COL -->

	</div>

	<!-- END ROW-->

</section>
<!-- end widget grid -->

<!-- SCRIPTS ON PAGE EVENT -->
<script type="text/javascript">
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();
	
	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 * 
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 * 
	 * TO LOAD A SCRIPT:
	 * var pagefunction = function (){ 
	 *  loadScript(".../plugin.js", run_after_loaded);	
	 * }
	 * 
	 * OR
	 * 
	 * loadScript(".../plugin.js", run_after_loaded);
	 */

	// PAGE RELATED SCRIPTS
	
	// pagefunction
	
	var pagefunction = function() {
		
	};
	
	// end pagefunction
	
	// run pagefunction on load
	pagefunction();

</script>
