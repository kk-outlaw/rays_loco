<?php
//�e�𕶎�����ǂꂾ�����炷��
$gap = empty($_GET['gap']) ? 4 : intval($_GET['gap']);

//�t�H���g�T�C�Y
$font_size = empty($_GET['font_size']) ? 128 : intval($_GET['font_size']);
//�e�L�X�g�̊p�x
$text_angle = 0;
//�t�H���g�̃p�X�F��΃p�X�Ŏw��
$font_file_name = realpath('../../') . '/rays_logo/NotoSerifJP-ExtraBold.ttf';

//�摜�̍��ォ��̃}�[�W��
$mergin_x = $font_size / 2;
$mergin_y = $font_size / 2;

//���S�ɂ���e�L�X�g
$text = empty($_GET['text']) ? "TB" : mb_substr($_GET['text'], 0, 24);

//�`��̈�̍��W���擾���A�摜�T�C�Y�̌v�Z�Ɏg�p����
$bounding_box = imagettfbbox(
    $font_size,
    $text_angle,
    $font_file_name,
    $text
    //PHP8.0�ł͈�����array $options = []���ǉ�����Ă���
);

//�摜�T�C�Y
$canvas_width = $mergin_x * 2 + $bounding_box[2] - $bounding_box[0];
$canvas_height = $mergin_y * 2 + $bounding_box[1] - $bounding_box[5];

//�L�����o�X�ƂȂ��̃C���[�W
$image = imagecreatetruecolor($canvas_width, $canvas_height);

//�w�i�F: 0C3261
$background_color = imagecolorallocate($image, 12, 50, 97);
//�����F: FFFFFF
$foreground_color = imagecolorallocate($image, 255, 255, 255);
//�e�̐F: 90BCE8
$shadow_color = imagecolorallocate($image, 144, 188, 232);

//�摜��w�i�F�œh��Ԃ�
imagefilledrectangle($image, 0, 0, $canvas_width, $canvas_height, $background_color);

//�e���ɏ�������
imagettftext(
    $image,
    $font_size,
    $text_angle,
    $mergin_x + $gap,
    $mergin_y + $gap + $font_size, //Y���͕����̉����K��
    $shadow_color,
    $font_file_name,
    $text
    //PHP8.0�ł�options = []�p�����[�^���Ō�ɒǉ�����Ă���
);
  
//�e�̏�ɔ�����������������
imagettftext(
    $image,
    $font_size,
    $text_angle,
    $mergin_x,
    $mergin_y + $font_size,
    $foreground_color,
    $font_file_name,
    $text
);

//�摜���o�͂���O�ɖ����I�Ƀ��X�|���X�w�b�_���o�͂���
header("Content-Type: image/png");
header('Content-Disposition: inline; filename="logo.png"');

//PNG�C���[�W�ŃX�g���[���o��
imagepng($image, null, -1, -1);

//�㏈��
imagedestroy($image);
?>