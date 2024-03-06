<h2>{{modeDesc}}</h2>
<section>
    {{if hasErrors}}
    <div class="error">
        <ul>
            {{with errors}}
            {{foreach global}}
            <li>{{this}}</li>
            {{endfor global}}
            {{endwith errors}}
        </ul>
    </div>
    {{endif hasErrors}}
    <form class="grid" action="index.php?page=Products_CategoryForm&mode={{mode}}&category_id={{category_id}}"
        method="post">
        <input type="hidden" name="category_id" value="{{category_id}}">
        <input type="hidden" name="mode" value="{{mode}}">
        <input type="hidden" name="crf_token" value="{{crf_token}}">
        <div class="row">
            <label class="col-3 offset-2" for="category_id">ID</label>
            <input class="col-5" type="text" name="category_id" id="category_id" value="{{category_id}}" disabled>
        </div>
        <div class="row">
            <label class="col-3 offset-2" for="category_name">Categoria</label>
            <input class="col-5" type="text" {{isReadOnly}} name="category_name" id="category_name"
                value="{{category_name}}">
            {{if hasErrors}}
            <div class="error col-5 offset-5">
                {{with errors}}
                {{foreach category_name_error}}
                {{this}}<br />
                {{endfor category_name_error}}
                {{endwith errors}}
            </div>
            {{endif hasErrors}}
        </div>
        <div class="row">
            <label class="col-3 offset-2" for="category_small_desc">Descripcion</label>
            <input class="col-5" type="text" {{isReadOnly}} name="category_small_desc" id="category_small_desc"
                value="{{category_small_desc}}">
            {{if hasErrors}}
            <div class="error col-5 offset-5">
                {{with errors}}
                {{foreach category_small_desc_error}}
                {{this}}<br />
                {{endfor category_small_desc_error}}
                {{endwith errors}}
            </div>
            {{endif hasErrors}}
        </div>
        <div class="row">
            <label class="col-3 offset-2" for="category_status">Status</label>
            <select class="col-5" id="category_status" name="category_status" {{if isReadOnly}} disabled readonly
                {{endif isReadOnly}}>
                {{foreach category_status_list}}
                <option value="{{value}}" {{selected}}>{{text}}</option>
                {{endfor category_status_list}}
            </select>
        </div>
        <div class="row">
            <div class="col-5 offset-5">
                {{if showAction}}
                <button type="submit" name="btnGuardar" id="btnGuardar">Guardar</button>
                &nbsp;
                {{endif showAction}}
                <button name="btnCancelar" id="btnCancelar">Cancelar</button>
            </div>
        </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btnCancelar = document.getElementById('btnCancelar');
        btnCancelar.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            window.location.href = 'index.php?page=Products_CategoriesList';
        });
    });
</script>