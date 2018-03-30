<?php while ($metabox->have_fields('webnus_seo_options', 1)): ?>
    <p>

    <table width="100%">
        <tr>
            <td><b>Seo Description:</b></td>
            <td width="60%">
                <textarea class="widefat" name="<?php $metabox->the_name('seo_desc'); ?>"><?php $metabox->the_value('seo_desc'); ?></textarea>

            </td>
        </tr>
         <tr>
            <td><b>Seo Keywords:<br/>(Comma separated. Example: key, word, sample, seo)</b></td>
            <td width="60%">
                <textarea class="widefat" name="<?php $metabox->the_name('seo_keyword'); ?>" ><?php $metabox->the_value('seo_keyword'); ?></textarea>

            </td>
        </tr>



    </table>


    </p>
<?php endwhile; ?>