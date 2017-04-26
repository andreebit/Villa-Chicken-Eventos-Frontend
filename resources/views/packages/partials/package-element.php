<script id="x_tpl_package_element" type="x-tmpl-mustache">
        <tr>
            <td>
                <?php echo Form::text('description[{{ id }}]', null, ['class' => 'form-control', 'placeholder' => 'Ingresa la descripción del elemento', 'maxlength' => 100, 'required' => 'required']) ?>
            </td>
            <td>
                <?php echo Form::select('service_category_id[{{ id }}]', $serviceCategories, null, ['class' => 'form-control', 'placeholder' => 'Escoja una categoría', 'required' => 'required']) ?>
            </td>
            <td>
                <a href="#" type="button" class="btn btn-danger btn-sm btn-remove-package-element">Quitar</a>
            </td>
        </tr>
    </script>