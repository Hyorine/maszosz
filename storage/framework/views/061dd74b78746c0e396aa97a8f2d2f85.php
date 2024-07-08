<div>
    <form method="post" action="<?php echo e(route('profilPOST')); ?>">
        <?php echo csrf_field(); ?>
        <h3>Értesítések:</h3>
        <input type="hidden" name="profilOperation" value="4">
        <div>
            <label>
                <input type="checkbox" name="notifications[event]" value="1" <?php echo e(isset($notifications['event']) && $notifications['event'] ? 'checked' : ''); ?>>
                Esemény
            </label>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="notifications[new_monster]" value="1" <?php echo e(isset($notifications['new_monster']) && $notifications['new_monster'] ? 'checked' : ''); ?>>
                Új szörny
            </label>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="notifications[watched_post]" value="1" <?php echo e(isset($notifications['watched_post']) && $notifications['watched_post'] ? 'checked' : ''); ?>>
                Figyelt fórum post
            </label>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="notifications[answered_post]" value="1" <?php echo e(isset($notifications['answered_post']) && $notifications['answered_post'] ? 'checked' : ''); ?>>
                Megválaszolt fórum post
            </label>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="notifications[friend_request]" value="1" <?php echo e(isset($notifications['friend_request']) && $notifications['friend_request'] ? 'checked' : ''); ?>>
                Barát felkérés
            </label>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="notifications[friend_accept]" value="1" <?php echo e(isset($notifications['friend_accept']) && $notifications['friend_accept'] ? 'checked' : ''); ?>>
                Barát elfogadás
            </label>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="notifications[private_message]" value="1" <?php echo e(isset($notifications['private_message']) && $notifications['private_message'] ? 'checked' : ''); ?>>
                Privát üzenet
            </label>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="notifications[moderation]" value="1" <?php echo e(isset($notifications['moderation']) && $notifications['moderation'] ? 'checked' : ''); ?>>
                Moderációs értesítés
            </label>
        </div>
        
        <div>
            <label>
                <input type="checkbox" name="notifications[followed_user]" value="1" <?php echo e(isset($notifications['followed_user']) && $notifications['followed_user'] ? 'checked' : ''); ?>>
                Követett felhasználó új
            </label>
        </div>
        
        <button type="submit" class="btn btn-primary">Mentés</button>
    </form>
</div>
<?php /**PATH /home/vagrant/code/maszosz/resources/views/profileNotification.blade.php ENDPATH**/ ?>