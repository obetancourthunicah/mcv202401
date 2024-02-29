<h2>Listado de Categorías</h2>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Status</th>
                <th>
                    <a href="index.php?page=Products_CategoryForm&mode=INS" class="btn">
                        Nuevo
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach categories}}
            <tr>
                <td>{{category_id}}</td>
                <td>{{category_name}}</td>
                <td>{{category_status}}</td>
                <td>
                    <a href="index.php?page=Products_CategoryForm&mode=DSP&category_id={{category_id}}">
                        Ver
                    </a>&nbsp;
                    <a href="index.php?page=Products_CategoryForm&mode=UPD&category_id={{category_id}}">
                        Editar
                    </a>&nbsp;
                    <a href="index.php?page=Products_CategoryForm&mode=DEL&category_id={{category_id}}">
                        Eliminar
                    </a>&nbsp;
                </td>
            </tr>
            {{endfor categories}}
        </tbody>
    </table>
</section>