<?php use yii\helpers\Url; ?>
<div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">

                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
                        <?php foreach ($populars as $popular) { ?>
                            <div class="popular-post">


                                <a href="<?= Url::toRoute(['site/view', 'id'=>$popular->id])?>" class="popular-img"><img src="<?= $popular->getImage(); ?>" alt="">

                                    <div class="p-overlay"></div>
                                </a>

                                <div class="p-content">
                                    <a href="<?= Url::toRoute(['site/view', 'id'=>$popular->id])?>" class="text-uppercase"><?= $popular->title; ?></a>
                                    <span class="p-date"><?= $popular->getDate(); ?></span>

                                </div>
                            </div>
                        <?php } ?>
                    </aside>
                    <aside class="widget pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>

                        <?php foreach ($recent as $value) { ?>
                            <div class="thumb-latest-posts">


                                <div class="media">
                                    <div class="media-left">
                                        <a href="<?= Url::toRoute(['site/view', 'id'=>$value->id])?>" class="popular-img"><img src="<?= $value->getImage(); ?>" alt="">
                                            <div class="p-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="p-content">
                                        <a href="<?= Url::toRoute(['site/view', 'id'=>$value->id])?>" class="text-uppercase"><?= $value->title ?></a>
                                        <span class="p-date"><?= $value->getDate(); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </aside>
                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Categories</h3>
                        <ul>
                            <?php foreach ($category as $cat) { ?>
                                <li>
                                    <a href="<?= Url::toRoute(['site/category', 'id'=>$cat->id])?>"><?= $cat->title; ?></a>
                                    <span class="post-count pull-right"> (<?= $cat->getArticlesCount(); ?>)</span>
                                </li>
                            <?php } ?>
                        </ul>
                    </aside>
                </div>
            </div>