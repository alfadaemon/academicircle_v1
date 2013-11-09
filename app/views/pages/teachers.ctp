  <!-- main -->
      <div id="main">

        <div class="post">
            <div class="right">

                    <h2><a href="./"><?php echo __d('pages', 'teachers', true)?></a></h2>

                    <p><?php echo __d('pages', 'teachersintro', true)?></p>

                </div>
				<div class="left">
                    <?php echo $html->image('teachers.gif', array('alt'=>'parents'));?>
                </div>
        </div>
        <div class="navigation clear">
            <div><?php echo $html->link(__d('pages', 'contactussubscribe', true), '/contacts/index'); ?></div>
        </div>
      </div>