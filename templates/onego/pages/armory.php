<?php
$global->check_logged_in();
$account = new Account($_SESSION['username']);
$armory = new Armory();

$character_stats = null;
$equipped_items = [];
$achievement_points = 0;
$recent_achievements = [];

if (isset($_GET['charid']) && is_numeric($_GET['charid'])) {
    $charid = (int)$_GET['charid'];
    
    $character_stats = $armory->getCharacterStats($charid);
    $equipped_items = $armory->getEquippedItems($charid);
    $achievement_points = $armory->getAchievementPoints($charid);
    $recent_achievements = $armory->getRecentAchievements($charid);
}
?>

<link rel="stylesheet" href="<?= $template_path ?>css/armory/app-BZ5hQrME.css">

<style>
    body {
        background-image: url('<?= $template_path ?>images/armory.jpg');
        background-size: cover; /* Adjusts the background image to cover the entire page */
        background-position: center; /* Centers the background image */
        background-repeat: no-repeat; /* Prevents the image from repeating */
        color: white; /* Change text color to increase contrast if needed */
    }
</style>

<script>const whTooltips = {colorLinks: true, iconizeLinks: false, renameLinks: false};</script>
<script src="https://wow.zamimg.com/widgets/power.js"></script>

<div class="container mt-3">
    <div class="flex flex-column">
        <div class="flex flex-column md:flex-row CharacterHeader relative CharacterHeader--WARRIOR">
            <div class="flex flex-row align-items-center justify-content-center">

                                    <div class="flex align-items-center" style="width: 84px; height: 84px;">
                        <img src="<?= $template_path ?>images/img/race/<?= htmlspecialchars($character_stats['race'] . '-' . $character_stats['gender']) ?>.png" alt="characters" class="border-round shadow-5">
                    </div>
                                <div class="flex flex-column ms-3 lg:w-full px-4">
                    <h1 class="CharacterHeader-nameTitle CharacterHeader-name m-0">
                        <?= htmlspecialchars($character_stats['name']) ?>
                    </h1>

                                            
                                    </div>
                <div class="p-divider p-component p-divider-vertical p-divider-solid p-divider-center hidden md:flex h-full"></div>
            </div>
            <div class="col-12 md:col flex flex-column md:flex-row align-self-center align-items-center md:align-items-start">
                <div class="flex flex-column flex-grow-1 align-self-center align-items-center md:align-items-start Media-tiny">
                    <div class="flex flex-row">
                                                    <div class="cursor-pointer p-2 text-primary-500 flex justify-content-center align-items-center text-primary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Achievement points">
                                
                                <img src="<?= $template_path ?>images/achievement.png" alt="achievement" class="h-10" /><span><?= htmlspecialchars($achievement_points) ?></span>
                            </div>
                                            </div>
                    <div class="px-2">
                        <?= $translations['level'] ?> <?= htmlspecialchars($character_stats['level']) ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-divider p-component p-divider-horizontal p-divider-solid p-divider-left my-3 block"></div>

      <!--	  <div class="p-tabview">
            <ul class="p-tabview-nav flex flex-column lg:flex-row" role="tablist">
                <li class="p-tabview-header p-highlight" role="presentation">
                    <a href="/" target="_self" class="p-tabview-nav-link p-tabview-header-action">
                        <span class="p-tabview-title">Персонаж</span>
                    </a>
                </li>
                                    <li class="p-tabview-header " role="presentation">
                        <a href="/" target="_self" class="p-tabview-nav-link p-tabview-header-action">
                            <span class="p-tabview-title">Достижения</span>
                        </a>
                    </li>
                            </ul>
        </div> -->
    </div>
</div>

<div class="container">
        <div class="grid g-0 mt-3">
            <div class="col-12 lg:col-8 position-relative character-equipment border-none lg:border-right-1 py-0">
                <div class="flex flex-row">
                    <div class="w-full flex flex-column item-bar-left">
                    <?php 
                    $left_items_indices = [0, 1, 2, 14, 4, 3, 18, 8];
                    foreach ($left_items_indices as $index): ?>
                        <a href="<?= $translations['wowhead_item'] ?><?= $equipped_items[$index]['id'] ?>" class="flex flex-row text-decoration-none has-item item-container w-full" data-wh-icon-size="large" data-wh-rename-link="true" target="_blank">
                            <div class="item-slot flex flex-column flex-center item-slot-item  border-1 border-solid overflow-hidden relative">
                                <img src="<?= htmlspecialchars($equipped_items[$index]['icon']) ?>">
                                <span class="mr-1 absolute bottom-0 z-3 left-0 right-0 item-level text-white"></span>
                            </div>
                            <div class="flex flex-column item-info align-self-center item-info-right">
                                <div class="">
                                    <?= htmlspecialchars($equipped_items[$index]['name']) ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    </div>
                    <div class="w-full flex flex-column item-bar-right align-content-end">
					<?php 
                    $right_items_indices = [9, 5, 6, 7, 10, 11, 12, 13];
                    foreach ($right_items_indices as $index): ?>
                        <a href="<?= $translations['wowhead_item'] ?><?= $equipped_items[$index]['id'] ?>" class="flex flex-row text-decoration-none has-item item-container  w-full" data-wh-icon-size="large" data-wh-rename-link="true" target="_blank">
                            <div class="item-slot flex flex-column flex-center item-slot-item  border-1 border-solid overflow-hidden relative">
                                <img src="<?= htmlspecialchars($equipped_items[$index]['icon']) ?>">
                                <span class="mr-1 absolute bottom-0 z-3 left-0 right-0 item-level text-white"></span>
                            </div>
                            <div class="flex flex-column item-info align-self-center item-info-left">
                                <div class="">
                                    <?= htmlspecialchars($equipped_items[$index]['name']) ?>
                                </div>
							</div>
                        </a>
					<?php endforeach; ?>
					</div>                                 
                </div><br>
                <div class="flex flex-row align-items-center">
    <?php 
    $bottom_items = [15, 16, 17];
    foreach ($bottom_items as $index): ?>
        <?php if (isset($equipped_items[$index])): ?>
            <a href="<?= $translations['wowhead_item'] ?><?= $equipped_items[$index]['id'] ?>" 
                data-wh-icon-size="large" data-wh-rename-link="true" target="_blank" 
                class="flex flex-row text-decoration-none has-item color-quality- item-container w-full expand-left flex-row-reverse">
                <div class="item-slot flex flex-column flex-center item-slot-item border-quality- border-1 border-solid overflow-hidden relative">
                    <img src="<?= htmlspecialchars($equipped_items[$index]['icon']) ?>" alt="<?= htmlspecialchars($equipped_items[$index]['name']) ?>" />
                    <span class="mr-1 absolute bottom-0 z-3 left-0 right-0 item-level text-white"></span>
                </div>

                <div class="flex flex-column item-info align-self-center item-info-left">
                    <div class="color-quality-">
                        <?= htmlspecialchars($equipped_items[$index]['name']) ?>
                    </div>
                    <div class="text-xs flex flex-row justify-content-end">
                        <div class="item-gems">
                        </div>
                    </div>
                </div>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

            </div>
            <div class="col-12 lg:col-4">
                <div class="mb-2">
        <div class="stats-header text-center p-2 text-primary font-bold uppercase">
            <?= $translations['statistics'] ?>
        </div>


                    <div class="stats-item flex flex-row px-2 py-1">
                <div class="mr-auto text-primary font-bold">
                    <?= $translations['health'] ?>
                </div>
                <div class="text-white">
                    <?= htmlspecialchars($character_stats['health']) ?>
                </div>
            </div>
                    <div class="stats-item flex flex-row px-2 py-1">
                <div class="mr-auto text-primary font-bold">
                    <?= $translations['intelligence'] ?>
                </div>
                <div class="text-white">
                    <?= htmlspecialchars($character_stats['power1']) ?>
                </div>
            </div>
                    <div class="stats-item flex flex-row px-2 py-1">
                <div class="mr-auto text-primary font-bold">
                    <?= $translations['honor'] ?>
                </div>
                <div class="text-white">
                    <?= htmlspecialchars($character_stats['totalHonorPoints']) ?>
                </div>
            </div>
                    <div class="stats-item flex flex-row px-2 py-1">
                <div class="mr-auto text-primary font-bold">
                    <?= $translations['arena'] ?>
                </div>
                <div class="text-white">
                    <?= htmlspecialchars($character_stats['arenaPoints']) ?>
                </div>
            </div>
                    <div class="stats-item flex flex-row px-2 py-1">
                <div class="mr-auto text-primary font-bold">
                    <?= $translations['kills'] ?>
                </div>
                <div class="text-white">
                    <?= htmlspecialchars($character_stats['totalKills']) ?>
                </div>
            </div>
                  <!--  <div class="stats-item flex flex-row px-2 py-1">
                <div class="mr-auto text-primary font-bold">
                    Звание
                </div>
                <div class="text-white">
                    <?= htmlspecialchars($character_stats['chosenTitle']) ?>
                </div>
            </div> -->
            </div>
			
			<div class="mb-2">
        <div class="stats-header text-center p-2 text-primary font-bold uppercase">
            <?= $translations['latest_achievements'] ?>
        </div>


                    <div class="stats-item flex flex-row px-2 py-1">
                <div class="mr-auto text-primary font-bold">
                    <?php foreach ($recent_achievements as $achievement): ?>
                            <li>
                                <a href="<?= $translations['wowhead_achievement'] ?><?= htmlspecialchars($achievement) ?>" data-wh-icon-size="medium" data-wh-rename-link="true" data-wowhead="achievement=<?= htmlspecialchars($achievement) ?>">
                                    Achievement <?= htmlspecialchars($achievement) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                </div>
                <div class="text-white">
                    
                </div>
            </div>
                    
            </div>
			
            </div>
			
        </div>
    </div> 
