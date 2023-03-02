<?php $__env->startSection('title'); ?>
    <?php echo e(Helper::webinfo()->site_title); ?> | <?php echo e(trans('labels.settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header"><?php echo e(trans('labels.settings')); ?></div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
                    <?php if(Session::has('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(Session::get('success')); ?>

                        <?php
                            Session::forget('success');
                        ?>
                    </div>
                    <?php endif; ?>

                    <?php if(Session::has('danger')): ?>
                    <div class="alert alert-danger">
                        <?php echo e(Session::get('danger')); ?>

                        <?php
                            Session::forget('danger');
                        ?>
                    </div>
                    <?php endif; ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="px-3">
                                <form class="form form-horizontal striped-rows form-bordered" method="post" action="<?php echo e(route('admin.settings.update')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" class="form-control" value="<?php echo e($data->id); ?>">
                                    <input type="hidden" name="old_img" class="form-control" value="<?php echo e($data->logo); ?>">
                                    <input type="hidden" name="old_favicon" class="form-control" value="<?php echo e($data->favicon); ?>">
                                    <input type="hidden" name="old_og_image" class="form-control" value="<?php echo e($data->og_image); ?>">
                                    <div class="form-body">
                                        <h4 class="form-section"><i class="ft-user"></i> <?php echo e(trans('labels.basic_info')); ?></h4>
                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="firebase_key"><?php echo e(trans('labels.firebase_key')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="firebase_key" class="form-control" placeholder="<?php echo e(trans('labels.firebase_key')); ?>" value="<?php echo e($data->firebase_key); ?>">
                                                <?php $__errorArgs = ['firebase_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 label-control" for="currency"><?php echo e(trans('labels.currency')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="currency" class="form-control" placeholder="<?php echo e(trans('labels.currency')); ?>" value="<?php echo e($data->currency); ?>">
                                                <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="currency_position"><?php echo e(trans('labels.currency_position')); ?></label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="currency_position">\
                                                    <option value=""><?php echo e(trans('labels.select_currency_position')); ?></option>
                                                    <option value="right" <?php echo e($data->currency_position == "right" ? 'selected' : ''); ?>><?php echo e(trans('labels.right')); ?></option>
                                                    <option value="left" <?php echo e($data->currency_position == "left" ? 'selected' : ''); ?>><?php echo e(trans('labels.left')); ?></option>
                                                </select>
                                                <?php $__errorArgs = ['currency_position'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="logo"><?php echo e(trans('labels.logo')); ?></label>
                                            <div class="col-md-9">
                                                <input type="file" name="logo" class="form-control" placeholder="<?php echo e(trans('labels.logo')); ?>">
                                                <img src='<?php echo e(Helper::image_path($data->logo)); ?>' class='media-object round-media height-50 mt-3'>
                                                <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="favicon"><?php echo e(trans('labels.favicon')); ?></label>
                                            <div class="col-md-9">
                                                <input type="file" name="favicon" class="form-control" placeholder="<?php echo e(trans('labels.favicon')); ?>">
                                                <img src='<?php echo e(Helper::image_path($data->favicon)); ?>' class='media-object round-media height-50 mt-3'>
                                                <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="min_balance"><?php echo e(trans('labels.withdrawable_balance')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="min_balance" class="form-control" placeholder="<?php echo e(trans('labels.min_balance')); ?>" value="<?php echo e($data->min_balance); ?>">
                                                <?php $__errorArgs = ['min_balance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="referral_amount"><?php echo e(trans('labels.referral_amount')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="referral_amount" class="form-control" placeholder="<?php echo e(trans('labels.referral_amount')); ?>" value="<?php echo e($data->referral_amount); ?>">
                                                <?php $__errorArgs = ['referral_amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="timezone"><?php echo e(trans('labels.timezone')); ?></label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="timezone" id="timezone">
                                                  <option value=""><?php echo e(trans('messages.select_timezone')); ?></option>
                                                  <option value="Pacific/Midway" <?php echo e($data->timezone == "Pacific/Midway"  ? 'selected' : ''); ?>>(GMT-11:00) Midway Island, Samoa</option>
                                                  <option value="America/Adak" <?php echo e($data->timezone == "America/Adak"  ? 'selected' : ''); ?>>(GMT-10:00) Hawaii-Aleutian</option>
                                                  <option value="Etc/GMT+10" <?php echo e($data->timezone == "Etc/GMT+10"  ? 'selected' : ''); ?>>(GMT-10:00) Hawaii</option>
                                                  <option value="Pacific/Marquesas" <?php echo e($data->timezone == "Pacific/Marquesas"  ? 'selected' : ''); ?>>(GMT-09:30) Marquesas Islands</option>
                                                  <option value="Pacific/Gambier" <?php echo e($data->timezone == "Pacific/Gambier"  ? 'selected' : ''); ?>>(GMT-09:00) Gambier Islands</option>
                                                  <option value="America/Anchorage" <?php echo e($data->timezone == "America/Anchorage"  ? 'selected' : ''); ?>>(GMT-09:00) Alaska</option>
                                                  <option value="America/Ensenada" <?php echo e($data->timezone == "America/Ensenada"  ? 'selected' : ''); ?>>(GMT-08:00) Tijuana, Baja California</option>
                                                  <option value="Etc/GMT+8" <?php echo e($data->timezone == "Etc/GMT+8"  ? 'selected' : ''); ?>>(GMT-08:00) Pitcairn Islands</option>
                                                  <option value="America/Los_Angeles" <?php echo e($data->timezone == "America/Los_Angeles"  ? 'selected' : ''); ?>>(GMT-08:00) Pacific Time (US & Canada)</option>
                                                  <option value="America/Denver" <?php echo e($data->timezone == "America/Denver"  ? 'selected' : ''); ?>>(GMT-07:00) Mountain Time (US & Canada)</option>
                                                  <option value="America/Chihuahua" <?php echo e($data->timezone == "America/Chihuahua"  ? 'selected' : ''); ?>>(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                                  <option value="America/Dawson_Creek" <?php echo e($data->timezone == "America/Dawson_Creek"  ? 'selected' : ''); ?>>(GMT-07:00) Arizona</option>
                                                  <option value="America/Belize" <?php echo e($data->timezone == "America/Belize"  ? 'selected' : ''); ?>>(GMT-06:00) Saskatchewan, Central America</option>
                                                  <option value="America/Cancun" <?php echo e($data->timezone == "America/Cancun"  ? 'selected' : ''); ?>>(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                                  <option value="Chile/EasterIsland" <?php echo e($data->timezone == "Chile/EasterIsland"  ? 'selected' : ''); ?>>(GMT-06:00) Easter Island</option>
                                                  <option value="America/Chicago" <?php echo e($data->timezone == "America/Chicago"  ? 'selected' : ''); ?>>(GMT-06:00) Central Time (US & Canada)</option>
                                                  <option value="America/New_York" <?php echo e($data->timezone == "America/New_York"  ? 'selected' : ''); ?>>(GMT-05:00) Eastern Time (US & Canada)</option>
                                                  <option value="America/Havana" <?php echo e($data->timezone == "America/Havana"  ? 'selected' : ''); ?>>(GMT-05:00) Cuba</option>
                                                  <option value="America/Bogota" <?php echo e($data->timezone == "America/Bogota"  ? 'selected' : ''); ?>>(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                                  <option value="America/Caracas" <?php echo e($data->timezone == "America/Caracas"  ? 'selected' : ''); ?>>(GMT-04:30) Caracas</option>
                                                  <option value="America/Santiago" <?php echo e($data->timezone == "America/Santiago"  ? 'selected' : ''); ?>>(GMT-04:00) Santiago</option>
                                                  <option value="America/La_Paz" <?php echo e($data->timezone == "America/La_Paz"  ? 'selected' : ''); ?>>(GMT-04:00) La Paz</option>
                                                  <option value="Atlantic/Stanley" <?php echo e($data->timezone == "Atlantic/Stanley"  ? 'selected' : ''); ?>>(GMT-04:00) Faukland Islands</option>
                                                  <option value="America/Campo_Grande" <?php echo e($data->timezone == "America/Campo_Grande"  ? 'selected' : ''); ?>>(GMT-04:00) Brazil</option>
                                                  <option value="America/Goose_Bay" <?php echo e($data->timezone == "America/Goose_Bay"  ? 'selected' : ''); ?>>(GMT-04:00) Atlantic Time (Goose Bay)</option>
                                                  <option value="America/Glace_Bay" <?php echo e($data->timezone == "America/Glace_Bay"  ? 'selected' : ''); ?>>(GMT-04:00) Atlantic Time (Canada)</option>
                                                  <option value="America/St_Johns" <?php echo e($data->timezone == "America/St_Johns" ? 'selected' : ''); ?>>(GMT-03:30) Newfoundland</option>
                                                  <option value="America/Araguaina" <?php echo e($data->timezone == "America/Araguaina"  ? 'selected' : ''); ?>>(GMT-03:00) UTC-3</option>
                                                  <option value="America/Montevideo" <?php echo e($data->timezone == "America/Montevideo"  ? 'selected' : ''); ?>>(GMT-03:00) Montevideo</option>
                                                  <option value="America/Miquelon" <?php echo e($data->timezone == "America/Miquelon"  ? 'selected' : ''); ?>>(GMT-03:00) Miquelon, St. Pierre</option>
                                                  <option value="America/Godthab" <?php echo e($data->timezone == "America/Godthab"  ? 'selected' : ''); ?>>(GMT-03:00) Greenland</option>
                                                  <option value="America/Argentina/Buenos_Aires" <?php echo e($data->timezone == "America/Argentina/Buenos_Aires"  ? 'selected' : ''); ?>>(GMT-03:00) Buenos Aires</option>
                                                  <option value="America/Sao_Paulo" <?php echo e($data->timezone == "America/Sao_Paulo"  ? 'selected' : ''); ?>>(GMT-03:00) Brasilia</option>
                                                  <option value="America/Noronha" <?php echo e($data->timezone == "America/Noronha"  ? 'selected' : ''); ?>>(GMT-02:00) Mid-Atlantic</option>
                                                  <option value="Atlantic/Cape_Verde" <?php echo e($data->timezone == "Atlantic/Cape_Verde"  ? 'selected' : ''); ?>>(GMT-01:00) Cape Verde Is.</option>
                                                  <option value="Atlantic/Azores" <?php echo e($data->timezone == "Atlantic/Azores"  ? 'selected' : ''); ?>>(GMT-01:00) Azores</option>
                                                  <option value="Europe/Belfast" <?php echo e($data->timezone == "Europe/Belfast"  ? 'selected' : ''); ?>>(GMT) Greenwich Mean Time : Belfast</option>
                                                  <option value="Europe/Dublin" <?php echo e($data->timezone == "Europe/Dublin"  ? 'selected' : ''); ?>>(GMT) Greenwich Mean Time : Dublin</option>
                                                  <option value="Europe/Lisbon" <?php echo e($data->timezone == "Europe/Lisbon"  ? 'selected' : ''); ?>>(GMT) Greenwich Mean Time : Lisbon</option>
                                                  <option value="Europe/London" <?php echo e($data->timezone == "Europe/London"  ? 'selected' : ''); ?>>(GMT) Greenwich Mean Time : London</option>
                                                  <option value="Africa/Abidjan" <?php echo e($data->timezone == "Africa/Abidjan"  ? 'selected' : ''); ?>>(GMT) Monrovia, Reykjavik</option>
                                                  <option value="Europe/Amsterdam" <?php echo e($data->timezone == "Europe/Amsterdam"  ? 'selected' : ''); ?>>(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                                  <option value="Europe/Belgrade" <?php echo e($data->timezone == "Europe/Belgrade"  ? 'selected' : ''); ?>>(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                                  <option value="Europe/Brussels" <?php echo e($data->timezone == "Europe/Brussels"  ? 'selected' : ''); ?>>(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                  <option value="Africa/Algiers" <?php echo e($data->timezone == "Africa/Algiers"  ? 'selected' : ''); ?>>(GMT+01:00) West Central Africa</option>
                                                  <option value="Africa/Windhoek" <?php echo e($data->timezone == "Africa/Windhoek"  ? 'selected' : ''); ?>>(GMT+01:00) Windhoek</option>
                                                  <option value="Asia/Beirut" <?php echo e($data->timezone == "Asia/Beirut"  ? 'selected' : ''); ?>>(GMT+02:00) Beirut</option>
                                                  <option value="Africa/Cairo" <?php echo e($data->timezone == "Africa/Cairo"  ? 'selected' : ''); ?>>(GMT+02:00) Cairo</option>
                                                  <option value="Asia/Gaza" <?php echo e($data->timezone == "Asia/Gaza"  ? 'selected' : ''); ?>>(GMT+02:00) Gaza</option>
                                                  <option value="Africa/Blantyre" <?php echo e($data->timezone == "Africa/Blantyre"  ? 'selected' : ''); ?>>(GMT+02:00) Harare, Pretoria</option>
                                                  <option value="Asia/Jerusalem" <?php echo e($data->timezone == "Asia/Jerusalem"  ? 'selected' : ''); ?>>(GMT+02:00) Jerusalem</option>
                                                  <option value="Europe/Minsk" <?php echo e($data->timezone == "Europe/Minsk" ? 'selected' : ''); ?>>(GMT+02:00) Minsk</option>
                                                  <option value="Asia/Damascus" <?php echo e($data->timezone == "Asia/Damascus" ? 'selected' : ''); ?>>(GMT+02:00) Syria</option>
                                                  <option value="Europe/Moscow" <?php echo e($data->timezone == "Europe/Moscow"  ? 'selected' : ''); ?>>(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                                  <option value="Africa/Addis_Ababa" <?php echo e($data->timezone == "Africa/Addis_Ababa"  ? 'selected' : ''); ?>>(GMT+03:00) Nairobi</option>
                                                  <option value="Asia/Tehran" <?php echo e($data->timezone == "Asia/Tehran"  ? 'selected' : ''); ?>>(GMT+03:30) Tehran</option>
                                                  <option value="Asia/Dubai" <?php echo e($data->timezone == "Asia/Dubai"  ? 'selected' : ''); ?>>(GMT+04:00) Abu Dhabi, Muscat</option>
                                                  <option value="Asia/Yerevan" <?php echo e($data->timezone == "Asia/Yerevan"  ? 'selected' : ''); ?>>(GMT+04:00) Yerevan</option>
                                                  <option value="Asia/Kabul" <?php echo e($data->timezone == "Asia/Kabul"  ? 'selected' : ''); ?>>(GMT+04:30) Kabul</option>
                                                  <option value="Asia/Yekaterinburg" <?php echo e($data->timezone == "Asia/Yekaterinburg"  ? 'selected' : ''); ?>>(GMT+05:00) Ekaterinburg</option>
                                                  <option value="Asia/Tashkent" <?php echo e($data->timezone == "Asia/Tashkent"  ? 'selected' : ''); ?>>(GMT+05:00) Tashkent</option>
                                                  <option value="Asia/Kolkata" <?php echo e($data->timezone == "Asia/Kolkata"  ? 'selected' : ''); ?>>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                                  <option value="Asia/Katmandu" <?php echo e($data->timezone == "Asia/Katmandu"  ? 'selected' : ''); ?>>(GMT+05:45) Kathmandu</option>
                                                  <option value="Asia/Dhaka" <?php echo e($data->timezone == "Asia/Dhaka"  ? 'selected' : ''); ?>>(GMT+06:00) Astana, Dhaka</option>
                                                  <option value="Asia/Novosibirsk" <?php echo e($data->timezone == "Asia/Novosibirsk"  ? 'selected' : ''); ?>>(GMT+06:00) Novosibirsk</option>
                                                  <option value="Asia/Rangoon" <?php echo e($data->timezone == "Asia/Rangoon"  ? 'selected' : ''); ?>>(GMT+06:30) Yangon (Rangoon)</option>
                                                  <option value="Asia/Bangkok" <?php echo e($data->timezone == "Asia/Bangkok"  ? 'selected' : ''); ?>>(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                                  <option value="Asia/Krasnoyarsk" <?php echo e($data->timezone == "Asia/Krasnoyarsk"  ? 'selected' : ''); ?>>(GMT+07:00) Krasnoyarsk</option>
                                                  <option value="Asia/Hong_Kong" <?php echo e($data->timezone == "Asia/Hong_Kong"  ? 'selected' : ''); ?>>(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                                  <option value="Asia/Irkutsk" <?php echo e($data->timezone == "Asia/Irkutsk"  ? 'selected' : ''); ?>>(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                                  <option value="Australia/Perth" <?php echo e($data->timezone == "Australia/Perth"  ? 'selected' : ''); ?>>(GMT+08:00) Perth</option>
                                                  <option value="Australia/Eucla" <?php echo e($data->timezone == "Australia/Eucla"  ? 'selected' : ''); ?>>(GMT+08:45) Eucla</option>
                                                  <option value="Asia/Tokyo" <?php echo e($data->timezone == "Asia/Tokyo"  ? 'selected' : ''); ?>>(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                                  <option value="Asia/Seoul" <?php echo e($data->timezone == "Asia/Seoul"  ? 'selected' : ''); ?>>(GMT+09:00) Seoul</option>
                                                  <option value="Asia/Yakutsk" <?php echo e($data->timezone == "Asia/Yakutsk"  ? 'selected' : ''); ?>>(GMT+09:00) Yakutsk</option>
                                                  <option value="Australia/Adelaide" <?php echo e($data->timezone == "Australia/Adelaide"  ? 'selected' : ''); ?>>(GMT+09:30) Adelaide</option>
                                                  <option value="Australia/Darwin" <?php echo e($data->timezone == "Australia/Darwin"  ? 'selected' : ''); ?>>(GMT+09:30) Darwin</option>
                                                  <option value="Australia/Brisbane" <?php echo e($data->timezone == "Australia/Brisbane"  ? 'selected' : ''); ?>>(GMT+10:00) Brisbane</option>
                                                  <option value="Australia/Hobart" <?php echo e($data->timezone == "Australia/Hobart"  ? 'selected' : ''); ?>>(GMT+10:00) Hobart</option>
                                                  <option value="Asia/Vladivostok" <?php echo e($data->timezone == "Asia/Vladivostok"  ? 'selected' : ''); ?>>(GMT+10:00) Vladivostok</option>
                                                  <option value="Australia/Lord_Howe" <?php echo e($data->timezone == "Australia/Lord_Howe"  ? 'selected' : ''); ?>>(GMT+10:30) Lord Howe Island</option>
                                                  <option value="Etc/GMT-11" <?php echo e($data->timezone == "Etc/GMT-11"  ? 'selected' : ''); ?>>(GMT+11:00) Solomon Is., New Caledonia</option>
                                                  <option value="Asia/Magadan" <?php echo e($data->timezone == "Asia/Magadan"  ? 'selected' : ''); ?>>(GMT+11:00) Magadan</option>
                                                  <option value="Pacific/Norfolk" <?php echo e($data->timezone == "Pacific/Norfolk"  ? 'selected' : ''); ?>>(GMT+11:30) Norfolk Island</option>
                                                  <option value="Asia/Anadyr" <?php echo e($data->timezone == "Asia/Anadyr"  ? 'selected' : ''); ?>>(GMT+12:00) Anadyr, Kamchatka</option>
                                                  <option value="Pacific/Auckland" <?php echo e($data->timezone == "Pacific/Auckland"  ? 'selected' : ''); ?>>(GMT+12:00) Auckland, Wellington</option>
                                                  <option value="Etc/GMT-12" <?php echo e($data->timezone == "Etc/GMT-12"  ? 'selected' : ''); ?>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                                  <option value="Pacific/Chatham" <?php echo e($data->timezone == "Pacific/Chatham"  ? 'selected' : ''); ?>>(GMT+12:45) Chatham Islands</option>
                                                  <option value="Pacific/Tongatapu" <?php echo e($data->timezone == "Pacific/Tongatapu"  ? 'selected' : ''); ?>>(GMT+13:00) Nuku'alofa</option>
                                                  <option value="Pacific/Kiritimati" <?php echo e($data->timezone == "Pacific/Kiritimati"  ? 'selected' : ''); ?>>(GMT+14:00) Kiritimati</option>
                                                </select>
                                                <?php $__errorArgs = ['timezone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="admin_commission"><?php echo e(trans('labels.admin_commission')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="admin_commission" class="form-control" placeholder="<?php echo e(trans('labels.admin_commission')); ?>" value="<?php echo e($data->admin_commission); ?>">
                                                <?php $__errorArgs = ['admin_commission'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="copyright"><?php echo e(trans('labels.copyright')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="copyright" class="form-control" placeholder="<?php echo e(trans('labels.copyright')); ?>" value="<?php echo e($data->copyright); ?>">
                                                <?php $__errorArgs = ['copyright'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="address"><?php echo e(trans('labels.address')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="address" class="form-control" placeholder="<?php echo e(trans('labels.address')); ?>" value="<?php echo e($data->address); ?>">
                                                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="contact"><?php echo e(trans('labels.contact')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="contact" class="form-control" placeholder="<?php echo e(trans('labels.contact')); ?>" value="<?php echo e($data->contact); ?>">
                                                <?php $__errorArgs = ['contact'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="email"><?php echo e(trans('labels.email')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="email" class="form-control" placeholder="<?php echo e(trans('labels.email')); ?>" value="<?php echo e($data->email); ?>">
                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <h4 class="form-section"><i class="fa fa-bar-chart"></i> <?php echo e(trans('labels.seo')); ?> </h4>
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="site_title"><?php echo e(trans('site_title')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="site_title" class="form-control" placeholder="<?php echo e(trans('labels.site_title')); ?>" value="<?php echo e($data->site_title); ?>">
                                                <?php $__errorArgs = ['site_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="meta_title"><?php echo e(trans('labels.meta_title')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="meta_title" class="form-control" placeholder="<?php echo e(trans('labels.meta_title')); ?>" value="<?php echo e($data->meta_title); ?>">
                                                <?php $__errorArgs = ['meta_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="meta_description"><?php echo e(trans('labels.meta_description')); ?></label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" name="meta_description" placeholder="<?php echo e(trans('labels.meta_description')); ?>"><?php echo e($data->meta_description); ?></textarea>
                                                <?php $__errorArgs = ['meta_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="og_image"><?php echo e(trans('labels.og_image')); ?></label>
                                            <div class="col-md-9">
                                                <input type="file" name="og_image" class="form-control" placeholder="<?php echo e(trans('labels.og_image')); ?>">
                                                <img src='<?php echo e(Helper::image_path($data->og_image)); ?>' class='media-object round-media height-50 mt-3'>
                                                <?php $__errorArgs = ['og_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-danger"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                        <h4 class="form-section"><i class="fa fa-bar-chart"></i> <?php echo e(trans('labels.social_accounts')); ?> </h4>
                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="facebook"><?php echo e(trans('labels.facebook')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="facebook" class="form-control" placeholder="<?php echo e(trans('labels.facebook')); ?>" value="<?php echo e($data->facebook); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="twitter"><?php echo e(trans('labels.twitter')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="twitter" class="form-control" placeholder="<?php echo e(trans('labels.twitter')); ?>" value="<?php echo e($data->twitter); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="instagram"><?php echo e(trans('labels.instagram')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="instagram" class="form-control" placeholder="<?php echo e(trans('labels.instagram')); ?>" value="<?php echo e($data->instagram); ?>">
                                            </div>
                                        </div>

                                        <div class="form-group row last">
                                            <label class="col-md-3 label-control" for="linkedin"><?php echo e(trans('labels.linkedin')); ?></label>
                                            <div class="col-md-9">
                                                <input type="text" name="linkedin" class="form-control" placeholder="<?php echo e(trans('labels.linkedin')); ?>" value="<?php echo e($data->linkedin); ?>">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions text-right">
                                        <?php if(env('Environment') == 'sendbox'): ?>
                                            <button type="button" class="btn btn-raised btn-primary" onclick="myFunction()"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.update')); ?></button>
                                        <?php else: ?>
                                            <button type="submit" id="btn_add_category" class="btn btn-raised btn-primary"> <i class="fa fa-check-square-o"></i> <?php echo e(trans('labels.update')); ?></button>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripttop'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/eglobalm/public_html/resources/views/Admin/settings/index.blade.php ENDPATH**/ ?>