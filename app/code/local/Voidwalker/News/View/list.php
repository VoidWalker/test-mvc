<table>
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>Id</td>
        <td>Title</td>
        <td>Content</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($news as $newOne) { ?>
        <tr>
            <td><?php if (isset($newOne->id)) echo $newOne->id; ?></td>
            <td><?php if (isset($newOne->title)) echo $newOne->title; ?></td>
            <td><?php if (isset($newOne->content)) echo $newOne->content; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>