PGDMP                 	        {            tokodb    15.2    15.2 2    F           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            G           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            H           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            I           1262    17705    tokodb    DATABASE     }   CREATE DATABASE tokodb WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Indonesia.1252';
    DROP DATABASE tokodb;
                postgres    false            �            1259    17746    admin_id_seq    SEQUENCE     z   CREATE SEQUENCE public.admin_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;
 #   DROP SEQUENCE public.admin_id_seq;
       public          postgres    false            �            1259    17745    cartcus_id_seq    SEQUENCE     |   CREATE SEQUENCE public.cartcus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;
 %   DROP SEQUENCE public.cartcus_id_seq;
       public          postgres    false            �            1259    17800    cartcus    TABLE     �   CREATE TABLE public.cartcus (
    cart_id integer DEFAULT nextval('public.cartcus_id_seq'::regclass) NOT NULL,
    cart_items_id integer NOT NULL,
    cart_cus_id integer NOT NULL,
    cart_jumlah integer NOT NULL,
    cart_tgl date NOT NULL
);
    DROP TABLE public.cartcus;
       public         heap    postgres    false    217            �            1259    17754 	   dataadmin    TABLE       CREATE TABLE public.dataadmin (
    admin_id integer DEFAULT nextval('public.admin_id_seq'::regclass) NOT NULL,
    admin_nama text NOT NULL,
    admin_email text NOT NULL,
    admin_nomor text NOT NULL,
    admin_user text NOT NULL,
    admin_alamat text
);
    DROP TABLE public.dataadmin;
       public         heap    postgres    false    218            �            1259    17727    datacus_id_seq    SEQUENCE     |   CREATE SEQUENCE public.datacus_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;
 %   DROP SEQUENCE public.datacus_id_seq;
       public          postgres    false            �            1259    17730    datacus    TABLE       CREATE TABLE public.datacus (
    customer_id integer DEFAULT nextval('public.datacus_id_seq'::regclass) NOT NULL,
    customer_nama text NOT NULL,
    customer_email text NOT NULL,
    customer_nomor text NOT NULL,
    customer_username text NOT NULL,
    customer_alamat text
);
    DROP TABLE public.datacus;
       public         heap    postgres    false    215            �            1259    17770    items    TABLE     �   CREATE TABLE public.items (
    items_id integer DEFAULT nextval('public.admin_id_seq'::regclass) NOT NULL,
    items_name text NOT NULL,
    items_describe text,
    items_price text NOT NULL,
    items_stock integer,
    items_admin integer
);
    DROP TABLE public.items;
       public         heap    postgres    false    218            �            1259    17769    items_id_seq    SEQUENCE     |   CREATE SEQUENCE public.items_id_seq
    START WITH 10
    INCREMENT BY 10
    MINVALUE 10
    MAXVALUE 9999999
    CACHE 1;
 #   DROP SEQUENCE public.items_id_seq;
       public          postgres    false            �            1259    17783    picture_id_seq    SEQUENCE     |   CREATE SEQUENCE public.picture_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 9999999
    CACHE 1;
 %   DROP SEQUENCE public.picture_id_seq;
       public          postgres    false            �            1259    17784    itemspic    TABLE     �   CREATE TABLE public.itemspic (
    picture_id integer DEFAULT nextval('public.picture_id_seq'::regclass) NOT NULL,
    picture_nama character varying(255) NOT NULL,
    items_id integer NOT NULL,
    image character varying(100) NOT NULL
);
    DROP TABLE public.itemspic;
       public         heap    postgres    false    223            �            1259    17747 
   loginadmin    TABLE     [   CREATE TABLE public.loginadmin (
    username text NOT NULL,
    passcode text NOT NULL
);
    DROP TABLE public.loginadmin;
       public         heap    postgres    false            �            1259    17706    logincus    TABLE     Y   CREATE TABLE public.logincus (
    username text NOT NULL,
    passcode text NOT NULL
);
    DROP TABLE public.logincus;
       public         heap    postgres    false            �            1259    17939    riwayatbeli    TABLE     �   CREATE TABLE public.riwayatbeli (
    riwayat_id integer NOT NULL,
    riwayat_items_id integer NOT NULL,
    riwayat_cus_id integer NOT NULL,
    riwayat_jumlah integer NOT NULL,
    riwayat_tgl date NOT NULL,
    riwayat_total integer
);
    DROP TABLE public.riwayatbeli;
       public         heap    postgres    false            B          0    17800    cartcus 
   TABLE DATA           ]   COPY public.cartcus (cart_id, cart_items_id, cart_cus_id, cart_jumlah, cart_tgl) FROM stdin;
    public          postgres    false    225   �:       =          0    17754 	   dataadmin 
   TABLE DATA           m   COPY public.dataadmin (admin_id, admin_nama, admin_email, admin_nomor, admin_user, admin_alamat) FROM stdin;
    public          postgres    false    220   /;       9          0    17730    datacus 
   TABLE DATA           �   COPY public.datacus (customer_id, customer_nama, customer_email, customer_nomor, customer_username, customer_alamat) FROM stdin;
    public          postgres    false    216   �;       ?          0    17770    items 
   TABLE DATA           l   COPY public.items (items_id, items_name, items_describe, items_price, items_stock, items_admin) FROM stdin;
    public          postgres    false    222   4<       A          0    17784    itemspic 
   TABLE DATA           M   COPY public.itemspic (picture_id, picture_nama, items_id, image) FROM stdin;
    public          postgres    false    224   �>       <          0    17747 
   loginadmin 
   TABLE DATA           8   COPY public.loginadmin (username, passcode) FROM stdin;
    public          postgres    false    219   {?       7          0    17706    logincus 
   TABLE DATA           6   COPY public.logincus (username, passcode) FROM stdin;
    public          postgres    false    214   #@       C          0    17939    riwayatbeli 
   TABLE DATA              COPY public.riwayatbeli (riwayat_id, riwayat_items_id, riwayat_cus_id, riwayat_jumlah, riwayat_tgl, riwayat_total) FROM stdin;
    public          postgres    false    226   �@       J           0    0    admin_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.admin_id_seq', 29, true);
          public          postgres    false    218            K           0    0    cartcus_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.cartcus_id_seq', 47, true);
          public          postgres    false    217            L           0    0    datacus_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.datacus_id_seq', 4, true);
          public          postgres    false    215            M           0    0    items_id_seq    SEQUENCE SET     <   SELECT pg_catalog.setval('public.items_id_seq', 10, false);
          public          postgres    false    221            N           0    0    picture_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.picture_id_seq', 14, true);
          public          postgres    false    223            �           2606    17763    dataadmin admin_user_uq 
   CONSTRAINT     m   ALTER TABLE ONLY public.dataadmin
    ADD CONSTRAINT admin_user_uq UNIQUE (admin_user) INCLUDE (admin_user);
 A   ALTER TABLE ONLY public.dataadmin DROP CONSTRAINT admin_user_uq;
       public            postgres    false    220            �           2606    17805    cartcus cart_id_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.cartcus
    ADD CONSTRAINT cart_id_pkey PRIMARY KEY (cart_id);
 >   ALTER TABLE ONLY public.cartcus DROP CONSTRAINT cart_id_pkey;
       public            postgres    false    225            �           2606    17937    cartcus cartcus_unique_key 
   CONSTRAINT     k   ALTER TABLE ONLY public.cartcus
    ADD CONSTRAINT cartcus_unique_key UNIQUE (cart_items_id, cart_cus_id);
 D   ALTER TABLE ONLY public.cartcus DROP CONSTRAINT cartcus_unique_key;
       public            postgres    false    225    225            �           2606    17739    datacus customer_user_uq 
   CONSTRAINT     `   ALTER TABLE ONLY public.datacus
    ADD CONSTRAINT customer_user_uq UNIQUE (customer_username);
 B   ALTER TABLE ONLY public.datacus DROP CONSTRAINT customer_user_uq;
       public            postgres    false    216            �           2606    17761    dataadmin dataadmin_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.dataadmin
    ADD CONSTRAINT dataadmin_pkey PRIMARY KEY (admin_id);
 B   ALTER TABLE ONLY public.dataadmin DROP CONSTRAINT dataadmin_pkey;
       public            postgres    false    220            �           2606    17737    datacus datacus_pkey 
   CONSTRAINT     [   ALTER TABLE ONLY public.datacus
    ADD CONSTRAINT datacus_pkey PRIMARY KEY (customer_id);
 >   ALTER TABLE ONLY public.datacus DROP CONSTRAINT datacus_pkey;
       public            postgres    false    216            �           2606    17777    items items_id_pkey 
   CONSTRAINT     W   ALTER TABLE ONLY public.items
    ADD CONSTRAINT items_id_pkey PRIMARY KEY (items_id);
 =   ALTER TABLE ONLY public.items DROP CONSTRAINT items_id_pkey;
       public            postgres    false    222            �           2606    17958    items items_stock_ck    CHECK CONSTRAINT     a   ALTER TABLE public.items
    ADD CONSTRAINT items_stock_ck CHECK ((items_stock >= 0)) NOT VALID;
 9   ALTER TABLE public.items DROP CONSTRAINT items_stock_ck;
       public          postgres    false    222    222            �           2606    17791    itemspic itemspic_pkey 
   CONSTRAINT     \   ALTER TABLE ONLY public.itemspic
    ADD CONSTRAINT itemspic_pkey PRIMARY KEY (picture_id);
 @   ALTER TABLE ONLY public.itemspic DROP CONSTRAINT itemspic_pkey;
       public            postgres    false    224            �           2606    17753    loginadmin loginadmin_pkey 
   CONSTRAINT     ^   ALTER TABLE ONLY public.loginadmin
    ADD CONSTRAINT loginadmin_pkey PRIMARY KEY (username);
 D   ALTER TABLE ONLY public.loginadmin DROP CONSTRAINT loginadmin_pkey;
       public            postgres    false    219            �           2606    17712    logincus logincus_pkey 
   CONSTRAINT     Z   ALTER TABLE ONLY public.logincus
    ADD CONSTRAINT logincus_pkey PRIMARY KEY (username);
 @   ALTER TABLE ONLY public.logincus DROP CONSTRAINT logincus_pkey;
       public            postgres    false    214            �           2606    17944    riwayatbeli riwayat_id_pkey 
   CONSTRAINT     a   ALTER TABLE ONLY public.riwayatbeli
    ADD CONSTRAINT riwayat_id_pkey PRIMARY KEY (riwayat_id);
 E   ALTER TABLE ONLY public.riwayatbeli DROP CONSTRAINT riwayat_id_pkey;
       public            postgres    false    226            �           2606    17764    dataadmin admin_username_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.dataadmin
    ADD CONSTRAINT admin_username_fkey FOREIGN KEY (admin_user) REFERENCES public.loginadmin(username);
 G   ALTER TABLE ONLY public.dataadmin DROP CONSTRAINT admin_username_fkey;
       public          postgres    false    220    219    3218            �           2606    17811    cartcus cus_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.cartcus
    ADD CONSTRAINT cus_id_fkey FOREIGN KEY (cart_cus_id) REFERENCES public.datacus(customer_id);
 =   ALTER TABLE ONLY public.cartcus DROP CONSTRAINT cus_id_fkey;
       public          postgres    false    225    216    3216            �           2606    17740    datacus customer_username_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.datacus
    ADD CONSTRAINT customer_username_fkey FOREIGN KEY (customer_username) REFERENCES public.logincus(username);
 H   ALTER TABLE ONLY public.datacus DROP CONSTRAINT customer_username_fkey;
       public          postgres    false    214    3212    216            �           2606    17778    items items_admin_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.items
    ADD CONSTRAINT items_admin_fkey FOREIGN KEY (items_admin) REFERENCES public.dataadmin(admin_id);
 @   ALTER TABLE ONLY public.items DROP CONSTRAINT items_admin_fkey;
       public          postgres    false    3222    222    220            �           2606    17806    cartcus items_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.cartcus
    ADD CONSTRAINT items_id_fkey FOREIGN KEY (cart_items_id) REFERENCES public.items(items_id);
 ?   ALTER TABLE ONLY public.cartcus DROP CONSTRAINT items_id_fkey;
       public          postgres    false    222    3224    225            �           2606    17929    itemspic items_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.itemspic
    ADD CONSTRAINT items_id_fkey FOREIGN KEY (items_id) REFERENCES public.items(items_id) NOT VALID;
 @   ALTER TABLE ONLY public.itemspic DROP CONSTRAINT items_id_fkey;
       public          postgres    false    222    224    3224            �           2606    17945    riwayatbeli rcus_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.riwayatbeli
    ADD CONSTRAINT rcus_id_fkey FOREIGN KEY (riwayat_cus_id) REFERENCES public.datacus(customer_id);
 B   ALTER TABLE ONLY public.riwayatbeli DROP CONSTRAINT rcus_id_fkey;
       public          postgres    false    216    3216    226            �           2606    17950    riwayatbeli ritems_id_fkey    FK CONSTRAINT     �   ALTER TABLE ONLY public.riwayatbeli
    ADD CONSTRAINT ritems_id_fkey FOREIGN KEY (riwayat_items_id) REFERENCES public.items(items_id);
 D   ALTER TABLE ONLY public.riwayatbeli DROP CONSTRAINT ritems_id_fkey;
       public          postgres    false    222    3224    226            B       x�31�42�4�4�4202�50"�=... 6��      =   Z   x�32�t�K��L���wH�M���K���4�026153371�L�+���r��gfsr:�����63R�0253��iK������ ��!x      9   �   x�U�1�0F�_��i�q��cbt0&:��RHڤ���tb����G���g������w�{XX*��u���<]���˷��mt�=�d2l-��gd8�Z�ig2�Xk=~�©S�EB㒄ev�$�� X*D��1�      ?   �  x��S�n�@}6_1R�>D��VM#�/���k�^7E��,�`.����w��B#U��Μs��z4�"լ���[�e�*p�zݪJTc����
�����m�ꥂM[�U��n��B?Q'Tj�a0��Vjͼ-,k�Q���؆'��P��^A��m��Юa{T��.aQ�E�{U����(Uw��5�B��Pn
j5`�E��v���Q�x�+�Z��� �ޮ^�$/��RA֙K�r����T�9u��)ת6G��PwW�.k<�m��ְ7�l��B�&�ӯ�2�!��h�__{G�v�m[�����JԞ�ʖd!ize�LP��C�A�K�����X���3��c�L��w���3�'�i���| �͑	p���2�H&&F���gٛ�K�BLhخW���5��u�2?��9��q
I�I�C�/�!�:�q���ݘSi�D��ń#< �9iGH����|�kG�q?b�Xև ���=��,쇟f��a���B�a�0�  %��q4�?$7s?!C�s!s3�S���s.2�����y��I�ɴ�؟�0A�S<?�$���^f��������ma~� �{��P��x
-'�l�c��n�.��ϙɪ1� $KN*�"f��tM�������t3���8��z�2�[�      A   �   x�34��M,�N-R�N��SIMJ�QpJ-�.M��,I,�42��@AW����X��L���10�3� ��\���t.CcN�����TN#(�#�S�΀ĂD�U�9��
�%��FX�ͱ�c�gb�g3'F��� s_=�      <   �   x�E���   �s|EΘ8J�jE�i.mº�0g:dh�����xb��z�]� ���t�����s5�3DA����8��$V�������tc�]��᭏��1A)E���	ђ�w�)l��↎�52,ڊW��+��U���SDi�bz�� ~�l/�      7   �   x��Kr�0  �us��c��e�`��!L7(�'a�P�����oЂ�,���a6z�����R���<_�����nfk!;X�.θ/r�G����8�w]���c�Wr^���US��$�4�`t
�@����G�D,���iJ�Z�C�g�t��[���	�-�I��u>��U�V����ƫЎ�x5����|# �?ҌC�      C   y   x�u�a� ��p�>��.��a���͍O|Cl#P!t�%6A�GX[7�P;|:T2(	@{���T�*c��3<K�:H�A���-�~`k�/p�s��V���Jԑ���c������i�>�     