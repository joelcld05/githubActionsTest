USE sig

-- ############################### VIEW VENTA

CREATE VIEW view_venta AS 
Select 
	vt.ID_venta as 'codigo',
    iv.ID_inv as 'cod_inv',
    iv.nombre as 'nombre',
    sc.nombre_sucursal as 'empresa',
    ls.ubicacion as 'ubicacion',
    vt.cantidad_solicitada as 'pedido',
    vt.precio_total as 'total',
    ur.ID_user AS 'user'
from 
	venta as vt 
    inner join inventario as iv on vt.ID_inv = iv.ID_inv
    inner join usuario as ur on ur.ID_local_scr = vt.ID_local_scr
    inner join local_scr as ls on ls.ID_local_src = ur.ID_local_scr
    inner join sucursal as sc on sc.ID_sucursal = ls.ID_scr 
   
-- ############################### END VIEW VENTA

-- ############################### 
-- ############################### UPDATE VENTA
DELIMITER //
CREATE procedure update_venta (
	in id_upt int,
    in cantd int
)
BEGIN
	set @upt = id_upt;
    set @cat = cantd;
	set @inv = (select ID_inv from venta where ID_venta = @upt);
	set @prc = (select precio_vt from ganancia_perdida where ID_inv = @inv);
    set @sol = (select cantidad_solicitada from venta where ID_venta = @upt);
    
	update venta set cantidad_solicitada = @cat  where ID_venta = @upt ;
    update venta set precio_total = (@prc * @cat) where ID_venta = @upt ;
    
    update ganancia_perdida set cantidad_vd = cantidad_vd - @sol where ID_inv = @inv;
    update ganancia_perdida set cantidad_vd = cantidad_vd + @cat where ID_inv = @inv;
    
    update ganancia_perdida set cantidad_cp = cantidad_cp + @sol where ID_inv = @inv;
    update ganancia_perdida set cantidad_cp = cantidad_cp - @cat where ID_inv = @inv;
    
    update ganancia_perdida set ganancia = (ganancia - (@prc * @sol)) where ID_inv = @inv;
    update ganancia_perdida set ganancia = (ganancia + (@prc * @cat)) where ID_inv = @inv;
    
    call sp_val_REORDEN();
END //
DELIMITER ;

-- ############################### END VIEW VENTA
-- ############################### 
-- -------------------------------------------------
-- ############################### 
-- ############################### DELL VENTA
DELIMITER //
CREATE procedure dell_venta (
	in id_del int
)
BEGIN
	set @del = id_del;
	set @inv = (select ID_inv from venta where ID_venta = @del);
    set @prc = (select precio_vt from ganancia_perdida where ID_inv = @inv);
    set @sol = (select cantidad_solicitada from venta where ID_venta = @del);
    
    

    update ganancia_perdida set cantidad_vd = cantidad_vd - @sol where ID_inv = @inv;
    update ganancia_perdida set cantidad_cp = cantidad_cp + @sol where ID_inv = @inv;
    update ganancia_perdida set ganancia = (ganancia - (@prc * @sol)) where ID_inv = @inv;
    
	delete from venta where ID_venta = @del;
    
    call sp_val_REORDEN();
END //
DELIMITER ;

-- ############################### END VIEW VENTA
-- ############################### 
-- -------------------------------------------------
-- ############################### 
-- ############################### DELL VENTA

CREATE VIEW productos_emp AS 
SELECT  
	INV.id_inv as "ID", 
	INV.nombre, 
	GP.cantidad_cp AS "cantidad", 
	DSC.desc as "descripcion", 
	TPO.tipo_prod as "tipo", 
	GP.precio_vt AS "precio_vt",
    GP.precio_cp AS "precio_cp",
	GP.reorden AS "reorden" 
from inventario as INV 
	INNER JOIN ganancia_perdida AS GP ON INV.ID_inv = GP.ID_inv
	inner join descripcion as DSC on INV.ID_desc = DSC.ID_desc 
	inner join tipo_producto as TPO  on INV.ID_tipo = TPO.ID_prod;
	
	
-- ############################### END VIEW VENTA
-- ############################### 
-- -------------------------------------------------
-- ############################### 
-- ############################### DELL VENTA
DELIMITER //
CREATE procedure update_reorden (
	in id_upt int,
    in cantd int
)
BEGIN
	set @id = id_upt;
	set @ctd = cantd;
    
	update ganancia_perdida set cantidad_cp = cantidad_cp + @ctd where ID_inv = @id;
    update ganancia_perdida set inversion = (inversion + (@ctd - precio_cp)) where ID_inv = @inv;
    
    call sp_val_REORDEN();
END //
DELIMITER ;
-- ############################### END VIEW VENTA
-- ############################### 
-- -------------------------------------------------
-- ############################### 
-- ############################### DELL VENTA
DELIMITER //
CREATE procedure dell_inventario (
	in id_del int
)
BEGIN
	set @del = id_del;
	delete from inventario where ID_inv = @del;
END //
DELIMITER ;

-- ############################### VIEW MOSTRAR DATOS USUARIO

CREATE VIEW mostra_datosUsuario
AS 
SELECT usuario.Image AS 'Imagen', usuario.Id_user, usuario.email, usuario.celular, r.tip_rol, s.nombre_sucursal, ls.ubicacion, nc.pri_nombre AS 'nombre', nc.pri_apellido AS 'apellido'
FROM usuario
INNER JOIN rol AS r ON usuario.ID_rol = r.ID_rol
INNER JOIN sucursal AS s ON usuario.ID_sucursal = s.ID_sucursal
INNER JOIN local_scr AS ls ON usuario.ID_local_scr = ls.ID_local_src
INNER JOIN nombre_completo AS nc ON  usuario.ID_nombre = nc.ID_nombre

-- ############################### END VIEW DATOS USUARIO
