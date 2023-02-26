-- a. Liệt kê các bài viết về các bài hát thuộc thể loại Nhạc trữ tình 
SELECT *
FROM baiviet
INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE theloai.ten_tloai = "Nhạc trữ tình"

-- b. Liệt kê các bài viết của tác giả “Nhacvietplus”
SELECT *
FROM baiviet
INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
WHERE tacgia.ten_tgia = "Nhacvietplus"

-- c. Liệt kê các thể loại nhạc chưa có bài viết cảm nhận nào
SELECT *
FROM theloai
WHERE ma_tloai NOT IN (SELECT ma_tloai FROM baiviet)

-- d. Liệt kê các bài viết với các thông tin sau: mã bài viết, tên bài viết, tên bài hát, tên tác giả, tên thể loại, ngày viết.
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, baiviet.ngayviet
FROM baiviet
INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai

-- e. Tìm thể loại có số bài viết nhiều nhất
SELECT * 
FROM theloai 
INNER JOIN baiviet ON baiviet.ma_tloai = theloai.ma_tloai
GROUP BY baiviet.ma_tloai
ORDER BY COUNT(baiviet.ma_tloai) DESC LIMIT 1

-- f. Liệt kê 2 tác giả có số bài viết nhiều nhất
SELECT tacgia.ma_tgia, tacgia.ten_tgia 
FROM tacgia 
INNER JOIN baiviet ON tacgia.ma_tgia = baiviet.ma_tgia
GROUP BY baiviet.ma_tgia
ORDER BY COUNT(baiviet.ma_tgia) DESC LIMIT 2

-- g. Liệt kê các bài viết về các bài hát có tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”,“em”
SELECT * 
FROM baiviet 
WHERE (ten_bhat LIKE "%yêu%") OR (ten_bhat LIKE "%thương%") OR (ten_bhat LIKE "%anh%") OR (ten_bhat LIKE "%em%")

-- h. Liệt kê các bài viết về các bài hát có tiêu đề bài viết hoặc tựa bài hát chứa 1 trong các từ “yêu”, “thương”, “anh”, “em”
SELECT * 
FROM baiviet 
WHERE (ten_bhat LIKE "%yêu%") OR (ten_bhat LIKE "%thương%") OR (ten_bhat LIKE "%anh%") OR (ten_bhat LIKE "%em%") OR (tieude LIKE "%yêu%") OR (tieude LIKE "%thương%") OR (tieude LIKE "%anh%") OR (tieude LIKE "%em%")


-- i. Tạo 1 view có tên vw_Music để hiển thị thông tin về Danh sách các bài viết kèm theo Tên thể loại và tên tác giả
CREATE VIEW vw_Music AS
SELECT baiviet.ma_bviet, baiviet.tieude, baiviet.ten_bhat, theloai.ma_tloai, baiviet.tomtat, baiviet.noidung, tacgia.ma_tgia, baiviet.ngayviet, baiviet.hinhanh
FROM baiviet
INNER JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
   

-- j. Tạo 1 thủ tục có tên sp_DSBaiViet với tham số truyền vào là Tên thể loại và trả về danh sách Bài viết của thể loại đó. Nếu thể loại không tồn tại thì hiển thị thông báo lỗi.
DELIMITER $$
CREATE PROCEDURE sp_DSBaiViet()
BEGIN
   SELECT * 
   FROM baiviet 
   INNER JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
   WHERE theloai.ten_tloai LIKE ten_tloai;
END; $$
DELIMITER ;

-- k. Thêm mới cột SLBaiViet vào trong bảng theloai. Tạo 1 trigger có tên tg_CapNhatTheLoai để khi thêm/sửa/xóa bài viết thì số lượng bài viết trong bảng theloai được cập nhật theo. (2 đ)ALTER TABLE theloai
ADD COLUMN SLBaiViet INT 

DELIMITER $$
CREATE TRIGGER tg_Them AFTER INSERT ON baiviet
FOR EACH ROW 
BEGIN 
    UPDATE theloai 
    SET SLBaiViet = (SELECT COUNT(*)
    				 FROM baiviet 
                     WHERE ma_tloai = New.ma_tloai) 
    WHERE ma_tloai = New.ma_tloai; 
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER tg_Xoa AFTER DELETE ON baiviet
FOR EACH ROW 
BEGIN
    UPDATE theloai 
    SET SLBaiViet = (SELECT COUNT(*)
        			 FROM baiviet 
                     WHERE ma_tloai = OLD.ma_tloai) 
    WHERE ma_tloai = OLD.ma_tloai; 
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER tg_capnhat AFTER UPDATE ON baiviet
FOR EACH ROW 
BEGIN
    UPDATE theloai 
    SET SLBaiViet = (SELECT COUNT(*)
    				 FROM baiviet 
                     WHERE ma_tloai = OLD.ma_tloai) 
    WHERE ma_tloai = OLD.ma_tloai;
    UPDATE theloai 
    SET SLBaiViet = (SELECT COUNT(*)
    				 FROM baiviet 
                     WHERE ma_tloai = New.ma_tloai) 
    WHERE ma_tloai = New.ma_tloai; 
END$$
DELIMITER ;

-- l. Bổ sung thêm bảng Users để lưu thông tin Tài khoản đăng nhập và sử dụng cho chức năng Đăng nhập/Quản trị trang web.
CREATE TABLE users (
    ma_ngdung INT UNSIGNED NOT NULL PRIMARY KEY,
    ten_dnhap VARCHAR(50) NOT NULL,
    mat_khau VARCHAR(20) NOT NULL
);
INSERT INTO users (ma_ngdung, ten_dnhap, mat_khau) VALUES
(1, 'nguyenvanduy', '123456'),
(2, 'nguyenthihaphuong', '456789'),
(3, 'buituanminh', 'abcdef'),
(4, 'nguyendangkhoa', 'ghiklm');