<table>
    <thead style="background-color: #ddd; font-weight: bold;">
    <tr>
        <td>Id</td>
        <td>Title</td>
        <td>Content</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($this->_news as $piceOfNews) { ?>
        <tr>
            <td><?php if (isset($piceOfNews->id)) echo $piceOfNews->id; ?></td>
            <td><?php if (isset($piceOfNews->title)) echo $piceOfNews->title; ?></td>
            <td><?php if (isset($piceOfNews->content)) echo $piceOfNews->content; ?></td>
            <td><a href="/voidwalker/news/news/del/id/<?php echo $piceOfNews->id; ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<!-- Input form -->
<form action="/voidwalker/news/news/set" method="post">
    <input type="text" name="title" />
    <input type="text" name="content" />
    <input type="submit" value="Save" />
</form>