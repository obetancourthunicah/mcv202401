<h1>Uso de vistas en Plantillero</h1>
<p>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quod ut quisquam id provident sed, dolore incidunt qui exercitationem itaque praesentium ea nemo, fugit a asperiores, aliquam odio repellat quasi consequatur!
</p>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Mensaje</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{nombre}}
            </td>
            <td>
                {{mensaje}}
            </td>
        </tr>
    </tbody>
    <section>
        {{foreach pulseras}}
        <div>
            <strong>{{sku}} {{nombre}} {{precio}}</strong>
        </div>
        {{endfor pulseras}}
    </section>
</table>