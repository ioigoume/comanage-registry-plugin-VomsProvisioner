-- noinspection SqlNoDataSourceInspectionForFile

CREATE TABLE cm_co_voms_provisioner_targets
(
    id                            serial PRIMARY KEY,
    co_provisioning_target_id     integer NOT NULL,
    co_voms_provisioner_server_id integer,
    vo                            varchar(96),
    robot_cert                    text,
    robot_key                     text,
    created                       timestamp without time zone,
    modified                      timestamp without time zone
);

CREATE UNIQUE INDEX cm_co_voms_provisioner_targets_i1 ON public.cm_co_voms_provisioner_targets USING btree (co_provisioning_target_id);
-- Add Foreign Key constraints
ALTER TABLE ONLY public.cm_co_voms_provisioner_targets
    ADD CONSTRAINT cm_co_voms_provisioner_targets_co_provisioning_target_id_fkey FOREIGN KEY (co_provisioning_target_id) REFERENCES public.cm_co_provisioning_targets (id);
ALTER TABLE ONLY public.cm_co_voms_provisioner_targets
    ADD CONSTRAINT cm_co_voms_provisioner_targets_co_voms_provisioner_server_id_fkey FOREIGN KEY (co_voms_provisioner_server_id) REFERENCES public.cm_co_voms_provisioner_servers(id);


CREATE TABLE cm_co_voms_provisioner_servers
(
    id                            serial PRIMARY KEY,
    co_voms_provisioner_target_id integer NOT NULL,
    host                          varchar(256),
    port                          integer,
    dn                            varchar(256),
    created                       timestamp without time zone,
    modified                      timestamp without time zone
);

CREATE UNIQUE INDEX cm_co_voms_provisioner_servers_i1 ON public.cm_co_voms_provisioner_servers USING btree (co_voms_provisioner_target_id);
-- Add Foreign Key constraints
ALTER TABLE ONLY public.cm_co_voms_provisioner_servers
    ADD CONSTRAINT cm_co_voms_provisioner_servers_co_voms_provisioner_target_id_fkey FOREIGN KEY (co_voms_provisioner_target_id) REFERENCES public.cm_co_voms_provisioner_targets (id);
