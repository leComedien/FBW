<?php

	class FBWidget extends WP_Widget {
		
		// constructeur qui fait appel a la classe mere

		public function __construct() {
			
			// Le premier est l’ID du widget, si false il sera défini automatiquement
			// Le deuxième est le nom du widget
			// Le troisième est un tableau de paramètres pour par exemple ajouter une description

			parent::WP_Widget(false, $name = 'fbwidget', array("description" => 'Facebook timeline '));
		}
		
		// modification des paramètres du widget
		
		public function update($new_instance, $old_instance) {
		
			/* Récupération des paramètres envoyés */
			$old_instance['fb'] = strip_tags($new_instance['fb']);
			$old_instance['width'] = $new_instance['width'];
			$old_instance['height'] = $new_instance['height'];
			$old_instance['colorScheme'] = $new_instance['colorScheme'];
			$old_instance['boolFaces'] = $new_instance['boolFaces'];
			$old_instance['boolStream'] = $new_instance['boolStream'];
			$old_instance['boolHeader'] = $new_instance['boolHeader'];
		 
			return $old_instance;
		}
		
		// affichage des paramètres du widget dans l'admin
			
		public function form($instance) {
			
			// formatage des variables pour eviter les erreurs HTML
			$fb = esc_attr($instance['fb']);
			$width = esc_attr($instance['width']);
			$height = esc_attr($instance['height']);
			$colorScheme = esc_attr($instance['colorScheme']);
			$boolFaces = esc_attr($instance['boolFaces']);
			$boolStream = esc_attr($instance['boolStream']);
			$boolHeader = esc_attr($instance['boolHeader']);


			?>
				<p>
					<label for="<?php echo $this->get_field_id('fb'); ?>">pseudo facebook :</label>
					<input class="widefat" id="<?php echo $this->get_field_id('fb'); ?>" name="<?php echo $this->get_field_name('fb'); ?>" type="text" value="<?php echo $fb; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('width'); ?>">width (minimimun 292) :</label>
					<input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $width; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('height'); ?>">height (minimimun 590) :</label>
					<input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $height; ?>" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('colorScheme'); ?>">Theme d'affichage :</label>
					<select name="<?php echo $this->get_field_name('colorScheme'); ?>"> 
						<option value="light" <?php if ($colorScheme == 'light') { echo 'selected="selected"'; } ?>>light</option>
						<option value="dark" <?php if ($colorScheme == 'dark') { echo 'selected="selected"'; } ?>>dark</option>
					</select>
				</p>
				<p>
					<label for="<?php echo $this->get_field_id('boolFaces'); ?>">Show Faces :</label>
					<input class="widefat" id="<?php echo $this->get_field_id('boolFaces'); ?>" name="<?php echo $this->get_field_name('boolFaces'); ?>" type="checkbox" <?php if($boolFaces) { echo 'checked="checked"'; } ?>" />
				</p>	 
				<p>
					<label for="<?php echo $this->get_field_id('boolStream'); ?>">Show Stream :</label>
					<input class="widefat" id="<?php echo $this->get_field_id('boolStream'); ?>" name="<?php echo $this->get_field_name('boolStream'); ?>" type="checkbox"  <?php if($boolStream) { echo 'checked="checked"'; } ?> />
				</p>	 
				<p>
					<label for="<?php echo $this->get_field_id('boolHeader'); ?>">Show Header :</label>
					<input class="widefat" id="<?php echo $this->get_field_id('boolHeader'); ?>" name="<?php echo $this->get_field_name('boolHeader'); ?>" type="checkbox"  <?php if($boolHeader) { echo 'checked="checked"'; } ?> />
				</p>
			<?php
		}
		
		public function widget($args, $instance) {
			
			if (isset($instance['fb']) && $instance['width'] > 291 && $instance['height'] > 589){
			
				echo '<iframe src="https://www.facebook.com/plugins/likebox.php?';
				echo 'href=http%3A%2F%2Fwww.facebook.com%2F'.$instance['fb'];
				echo '&amp;';
				echo 'width='.$instance['width'];
				echo '&amp;';
				echo 'height='.$instance['height'];
				echo '&amp;';
				echo 'colorscheme='.$instance['colorScheme'];
				echo '&amp;';
				echo 'show_faces='.$instance['boolFaces'];
				echo '&amp;';
				echo 'border_color';
				echo '&amp;';
				echo 'stream='.$instance['boolStream'];
				echo '&amp;';
				echo 'header='.$instance['boolHeader'].'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; ';
				echo 'width:'.$instance['width'].'px; height:'.$instance['height'].'px;" allowTransparency="true">';
				echo '</iframe>';
				
			}
			else{
			
				echo 'Il y a une ou plusieurs erreurs dans le formulaire';
			}
		}
	}
	
?>