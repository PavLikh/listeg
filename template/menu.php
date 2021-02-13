
        <ul class="<?=$class ?>">
            <?php foreach ($menu as $value) { ?>
                <li><a href="<?=$value['path'] ?>" class="<?=isCurrentUrl($value['path']) ? 'current' : ''  ?>"><?=trimLine($value['title'])?></a></li>
            <?php }; ?>
        </ul>
