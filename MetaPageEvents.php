<?php

namespace FDevs\MetaPage;


final class MetaPageEvents
{
    /**
     * The CREATE_META_CONFIG event occurs when the creation meta config.
     *
     * This event allows you to modify the default values of the user before binding the form.
     * The event listener method receives a FDevs\MetaPage\Event\MetaConfigEvent instance.
     */
    const CREATE_META_CONFIG = 'f_devs_meta_page.create_meta_config';
}
