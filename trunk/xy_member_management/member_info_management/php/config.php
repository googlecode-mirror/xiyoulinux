<?php
/*
 * ����ı����������Ŀ¼�������ݿ⣬������Ҫ�޸����в�����
 */
 
// ���ݿ�
$server = "localhost";
$userName = "root";
$password = "";

// �û�ͼƬ����Ŀ¼
// ע���Ŀ¼·������������·����Ҳ����������·��
$image_path = "http://localhost/member_info_management/image/" . $_SESSION['user_name'] . ".jpg";
// ��ͼƬĿ¼����Session
$_SESSION['image_path'] = $image_path;
?>