<?php
/** no direct access **/
defined('MECEXEC') or die();

/** @var MEC_feature_ix $this */

$third_parties = $this->main->get_integrated_plugins_for_import();
?>
<div class="wrap" id="mec-wrap">
    <h1><?php _e('MEC Import / Export', 'mec'); ?></h1>
    <h2 class="nav-tab-wrapper">
        <a href="<?php echo $this->main->remove_qs_var('tab'); ?>" class="nav-tab"><?php echo __('Google Cal. Import', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-g-calendar-export'); ?>" class="nav-tab"><?php echo __('Google Cal. Export', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-f-calendar-import'); ?>" class="nav-tab"><?php echo __('Facebook Cal. Import', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-meetup-import'); ?>" class="nav-tab"><?php echo __('Meetup Import', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-sync'); ?>" class="nav-tab"><?php echo __('Synchronization', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-export'); ?>" class="nav-tab"><?php echo __('Export', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-import'); ?>" class="nav-tab"><?php echo __('Import', 'mec'); ?></a>
        <a href="<?php echo $this->main->add_qs_var('tab', 'MEC-thirdparty'); ?>" class="nav-tab nav-tab-active"><?php echo __('Third Party Plugins', 'mec'); ?></a>
    </h2>
    <div class="mec-container">
        <div class="import-content w-clearfix extra">
            <h3><?php _e('Third Party Plugins', 'mec'); ?></h3>
            <form id="mec_thirdparty_import_form" action="<?php echo $this->main->get_full_url(); ?>" method="POST">
                <div class="mec-form-row">
                    <p><?php echo sprintf(__("You can import events from the following integrated plugins to %s.", 'mec'), '<strong>'.__('Modern Events Calendar', 'mec').'</strong>'); ?></p>
                </div>
                <div class="mec-form-row">
                    <select name="ix[third-party]" id="third_party" title="<?php esc_attr_e('Third Party', 'mec') ?>">
                        <?php foreach($third_parties as $third_party=>$label): ?>
                            <option <?php echo ((isset($this->ix['third-party']) and $this->ix['third-party'] == $third_party) ? 'selected="selected"' : ''); ?> value="<?php echo $third_party; ?>"><?php echo $label; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="mec-ix-action" value="thirdparty-import-start" />
                    <button class="button button-primary mec-button-primary mec-btn-2"><?php _e('Start', 'mec'); ?></button>
                </div>
            </form>

            <?php if($this->action == 'thirdparty-import-start'): ?>
                <div class="mec-ix-thirdparty-import-started">
                    <?php if($this->response['success'] == 0): ?>
                        <div class="mec-error"><?php echo $this->response['message']; ?></div>
                    <?php elseif(isset($this->response['data']['count']) && !$this->response['data']['count']): ?>
                        <div class="mec-error"><?php echo __('No events found!', 'mec'); ?></div>
                    <?php else: ?>
                        <form id="mec_thirdparty_import_do_form" action="<?php echo $this->main->get_full_url(); ?>" method="POST">
                            <div class="mec-ix-thirdparty-import-events mec-options-fields">
                                <h4><?php _e('Found Events', 'mec'); ?></h4>
                                <div class="mec-success"><?php echo sprintf(__('We found %s events. Please select your desired events to import.', 'mec'), '<strong>'.$this->response['data']['count'].'</strong>'); ?></div>
                                <ul class="mec-select-deselect-actions" data-for="#mec_import_thirdparty_events">
                                    <li data-action="select-all"><?php _e('Select All', 'mec'); ?></li>
                                    <li data-action="deselect-all"><?php _e('Deselect All', 'mec'); ?></li>
                                    <li data-action="toggle"><?php _e('Toggle', 'mec'); ?></li>
                                </ul>
                                <ul id="mec_import_thirdparty_events">
                                    <?php foreach($this->response['data']['events'] as $event): if(trim($event->post_title) == '') continue; ?>
                                    <li>
                                        <label>
                                            <input type="checkbox" name="tp-events[]" value="<?php echo $event->ID; ?>" checked="checked" />
                                            <span><?php echo sprintf(__('Event Title: %s', 'mec'), '<strong>'.$event->post_title.'</strong>'); ?></span>
                                        </label>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="mec-options-fields">
                                <h4><?php _e('Import Options', 'mec'); ?></h4>

                                <?php if(!in_array($this->ix['third-party'], array('event-espresso', 'events-manager-single', 'events-manager-recurring'))): ?>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="checkbox" name="ix[import_organizers]" value="1" checked="checked" />
                                        <?php
                                            if($this->ix['third-party'] == 'weekly-class') _e('Import Instructors', 'mec');
                                            else _e('Import Organizers', 'mec');
                                        ?>
                                    </label>
                                </div>
                                <?php endif; ?>

                                <div class="mec-form-row">
                                    <label>
                                        <input type="checkbox" name="ix[import_locations]" value="1" checked="checked" />
                                        <?php _e('Import Locations', 'mec'); ?>
                                    </label>
                                </div>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="checkbox" name="ix[import_categories]" value="1" checked="checked" />
                                        <?php
                                            if($this->ix['third-party'] == 'weekly-class') _e('Import Class Types', 'mec');
                                            else _e('Import Categories', 'mec');
                                        ?>
                                    </label>
                                </div>
                                <div class="mec-form-row">
                                    <label>
                                        <input type="checkbox" name="ix[import_featured_image]" value="1" checked="checked" />
                                        <?php _e('Import Featured Images', 'mec'); ?>
                                    </label>
                                </div>
                                <input type="hidden" name="mec-ix-action" value="thirdparty-import-do" />
                                <input type="hidden" name="ix[third-party]" value="<?php echo $this->ix['third-party']; ?>" />
                                <button id="mec_ix_thirdparty_import_do_form_button" class="button button-primary mec-button-primary" type="submit"><?php _e('Import', 'mec'); ?></button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            <?php elseif($this->action == 'thirdparty-import-do'): ?>
                <div class="mec-col-12 mec-ix-thirdparty-import-do">
                    <?php if($this->response['success'] == 0): ?>
                        <div class="mec-error"><?php echo $this->response['message']; ?></div>
                    <?php else: ?>
                        <div class="mec-success"><?php echo sprintf(__('%s events successfully imported to your website.', 'mec'), '<strong>'.$this->response['data'].'</strong>'); ?></div>
                        <div class="info-msg"><strong><?php _e('Attention', 'mec'); ?>:</strong> <?php _e("Although we tried our best to make the events completely compatible with MEC but some modification might be needed. We suggest you to edit the imported listings one by one on MEC edit event page and make sure they are correct.", 'mec'); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>