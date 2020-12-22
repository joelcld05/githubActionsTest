use sig;

select * from inventario;

SET SQL_SAFE_UPDATES=0;
update inventario set reorden = 0;

SET SQL_SAFE_UPDATES=0;
update inventario set cant_min = 200;


-- VALIDAR PARA REESTABLECER EL PUNTO DE REORDEN
DELIMITER //
create procedure sp_val_REORDEN()
begin
	SET SQL_SAFE_UPDATES=0;
	UPDATE LOW_PRIORITY IGNORE inventario 
	set reorden = case 
    when cantidad < cant_min then 1
    when cantidad >= cant_min then 0 end;
end//
DELIMITER ;
CALL sp_val_REORDEN();

-- CREWACION DE VISTA EMP
create view productos_EMP as 
select  INV.id_inv as "ID", INV.nombre, INV.precio, INV.cantidad, DSC.desc as "descripcion", TPO.tipo_prod as "tipo", INV.reorden 
from inventario as INV 
inner join descripcion as DSC on INV.ID_desc = DSC.ID_desc 
inner join tipo_producto as TPO  on INV.ID_tipo = TPO.ID_prod;

