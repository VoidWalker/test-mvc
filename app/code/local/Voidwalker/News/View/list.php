<table>
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>Id</td>
        <td>Title</td>
        <td>Content</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($news as $piceOfNews) { ?>
        <tr>
            <td><?php if (isset($piceOfNews->id)) echo $piceOfNews->id; ?></td>
            <td><?php if (isset($piceOfNews->title)) echo $piceOfNews->title; ?></td>
            <td><?php if (isset($piceOfNews->content)) echo $piceOfNews->content; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>