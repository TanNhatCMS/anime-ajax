 <?php
 $c = 1;
$stmt = $conn->query("SELECT * FROM info ORDER By views DESC LIMIT 10");
while($row = $stmt->fetch()):                  ?>
    <div class="swiper-slide">
        <div class="item">
            <div class="number">
                <span><?php echo str_pad($c, 2, '0', STR_PAD_LEFT);?></span>
                <div class="film-title dynamic-name" data-jname="<?php echo $row['title'] ?>"><?php echo $row['title'] ?></div>
            </div>
            <a href="/anime/<?php echo $row['slug'] ?>" class="film-poster tooltipEl" animeid="<?php echo $row['id'] ?>" title="<?php echo $row['title'] ?>">
            <img data-src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/uploads/images/<?php echo $row['slug'] ?>/<?php echo str_replace(' ', '%20', $row['image']); ?>" src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/theme/6anime/assets/images/no_poster.jpg" class="film-poster-img lazyload" alt="<?php echo $row['title'] ?>">
            </a>
            <div class="clearfix"></div>
        </div>
    </div>
<?php $c++; endwhile; ?>