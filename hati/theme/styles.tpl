/* auto-generated file / all manual changes will be lost */

/* <custom fonts import> */

<?php $fontsReq = str_replace(' ', '+', implode('|', $this->fonts)); if ($fontsReq) : ?>
@import url('http://fonts.googleapis.com/css?family=<?php echo $fontsReq ?>');
<?php endif; ?>

/* <custom fonts init> */

<?php foreach ($this->fonts as $t=>$f): $name = preg_replace('/:.*$/', '', $f) ?>
<?php switch ($t): case 'family': ?>
body { font-family: '<?php echo $name ?>', 'Georgia', serif }
<?php break; endswitch; endforeach; ?>

/* <custom colors> */

.commentlist li.bypostauthor h4,
.commentlist li.bypostauthor p,
.media-desc.desc h3,
.media-desc.desc h2 b,
.media-desc.desc strong,
.post h1,
.post h2,
.thumbs .item.hover h2,
.thumbs .item:hover h2,
h4,
blockquote,
.note,
th,
.active a,
a:hover { color: <?php echo $this->textC ?> }

blockquote { border-color: <?php echo $this->textC ?> }

#searchform input[type="text"],
html, body { color: <?php echo $this->textC_L ?> }

.active a,
input[type="submit"]:hover,
a:hover { background: <?php echo $this->hoverC ?> }

input,
textarea,
a { color: <?php echo $this->linkC ?> } 

#contact .name:before,
#contact .mail:before,
#contact .msg:before,
#contact .name:after,
#contact .mail:after,
#contact .msg:after { background-color: <?php echo $this->textC_SL ?> }

.widget.widget_search input#s,
.fieldset input,
.fieldset textarea,
.main h3,
p.info,
.note.light { border-color: <?php echo $this->textC_SL ?> }

.media-desc.desc h2 { color: <?php echo $this->blend ?> }

/* <custom css> */

<?php echo $this->css ?>
