
USE master
DROP DATABASE ControlEscolar

CREATE DATABASE ControlEscolar;

USE ControlEscolar;

CREATE TABLE Alumno(

idAlumno int IDENTITY(1,1) PRIMARY KEY,
nombre VARCHAR(50),
apellidoPaterno VARCHAR(50),
apellidoMaterno VARCHAR(50),
usuario VARCHAR(20),
contrasenia VARCHAR(100)

);

CREATE TABLE Materia(
idMateria int IDENTITY(1,1) PRIMARY KEY,
nombre VARCHAR(50),
costo DECIMAL(5,2)
);

CREATE TABLE Materiasalumno(
id int IDENTITY(1,1) PRIMARY KEY,
idAlumno int,
idMateria int,
FOREIGN KEY(idAlumno)REFERENCES Alumno(idAlumno),
FOREIGN KEY(idMateria)REFERENCES Materia(idMateria)
)

CREATE PROCEDURE addStudent 
	@Name varchar(50),
	@LastName1 varchar(50),
	@LastName2 varchar(50),
	@User varchar(20),
	@Contrasenia varchar(100)
AS
	INSERT INTO Alumno(nombre,apellidoPaterno,apellidoMaterno,usuario,contrasenia) VALUES(@Name,@LastName1,@LastName2,@User,@Contrasenia);
GO

EXECUTE addStudent 'ADMIN','','','ADMIN1','admin'

SELECT * FROM Alumno 

CREATE PROCEDURE deleteStudent
	@id int
AS
DELETE FROM Materiasalumno WHERE idAlumno = @id
DELETE FROM Alumno WHERE idAlumno = @id
GO

EXEC deleteStudent 23

CREATE PROCEDURE getStudents 
AS
SELECT idAlumno, nombre , apellidoPaterno, apellidoMaterno, usuario
FROM Alumno
GO

DROP PROCEDURE getStudents

EXEC getStudents


INSERT INTO Materia (nombre,costo) VALUES ('Español',509.15)

INSERT INTO Materia (nombre,costo) VALUES ('Matematicas',618.20)

INSERT INTO Materia (nombre,costo) VALUES ('Ciencias Naturales',707.25)

INSERT INTO Materia (nombre,costo) VALUES ('Historia',726.30)

INSERT INTO Materia (nombre,costo) VALUES ('Civismo',835.35)

INSERT INTO Materia (nombre,costo) VALUES ('Geografia',844.40)


SELECT * FROM Materia


CREATE PROCEDURE agregarAlumnoMateria
@idAlumno int ,
@idMateria int
AS
BEGIN
INSERT INTO Materiasalumno(idAlumno,idMateria) VALUES(@idAlumno,@idMateria)
END
GO

DROP PROCEDURE agregarAlumnoMateria

EXEC agregarAlumnoMateria 28,8


CREATE PROCEDURE materiasInscritasAlumno
@idAlumno int
AS
BEGIN
SELECT idMateria,nombre,costo
FROM Materia
WHERE idMateria IN
(SELECT idMateria
	FROM  Materiasalumno
	WHERE idAlumno = @idAlumno)
END
GO

EXEC materiasInscritasAlumno 28

UPDATE Materia
SET nombre='Espaniol'
WHERE nombre = 'Español'

SELECT * FROM Materiasalumno

CREATE PROCEDURE nombreAlumno
@idAlumno int
AS
SELECT nombre, apellidoPaterno,apellidoMaterno
FROM Alumno
WHERE idAlumno = @idAlumno
GO

EXEC nombreAlumno 28

CREATE PROCEDURE precioTotal 
@idAlumno int
AS
BEGIN
SELECT SUM(costo) AS 'costo'
FROM Materia
WHERE idMateria IN
(SELECT idMateria
	FROM  Materiasalumno
	WHERE idAlumno = @idAlumno)
END



EXEC precioTotal 26

CREATE PROCEDURE  eliminarMateriaAlumno
@idAlumno int,
@idMateria int
AS
BEGIN
	DELETE FROM Materiasalumno WHERE idAlumno = @idAlumno AND idMateria = @idMateria
END

EXEC eliminarMateriaAlumno 28, 8


CREATE PROCEDURE materiasNoRegistradas
@idAlumno int
AS
BEGIN
	SELECT idMateria , nombre  
	FROM Materia
	WHERE idMateria NOT IN(SELECT idMateria
	FROM Materiasalumno WHERE idAlumno = @idAlumno)
END
GO

EXEC materiasNoRegistradas 28

CREATE PROCEDURE login
@user varchar(20),
@contrasenia varchar(100)
AS
BEGIN
SELECT * FROM Alumno
WHERE usuario = @user AND contrasenia = @contrasenia
END
GO

EXEC login 'd.jimenez63','P9f49zD2'


SELECT * FROM Alumno

CREATE PROCEDURE getMaterias
AS
SELECT * FROM Materia
GO


EXEC getMaterias

CREATE PROCEDURE alumnosMateria
@idMateria int
AS
SELECT nombre, apellidoMaterno, apellidoPaterno,usuario
FROM Alumno
WHERE idAlumno IN
(SELECT idAlumno FROM Materiasalumno WHERE idMateria = @idMateria)



EXEC alumnosMateria 7


SELECT * FROM Alumno

CREATE PROCEDURE userP 
@user varchar(20)
AS
SELECT usuario,contrasenia ,nombre, apellidoPaterno, apellidoMaterno
FROM Alumno
WHERE usuario = @user

DROP PROCEDURE userP 

EXEC userP 'd.jimenez63'








