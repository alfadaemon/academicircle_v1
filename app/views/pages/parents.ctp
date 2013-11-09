  <!-- main -->
      <div id="main">

        <div class="post">
            <div class="right">

                    <h2><a href="./"><?php echo __d('pages', 'parents', true);?></a></h2>

                    <p><?php echo __d('pages', 'parentsintro', true);?></p>

                </div>
				<div class="left">
                    <?php echo $html->image('parents.gif', array('alt'=>'parents'));?>
                </div>
        </div>
        <div class="navigation clear">
            <div><?php echo $html->link(__d('pages', 'contactussubscribe', true), '/contacts/index'); ?></div>
        </div>
      </div>