   CREATE FUNCTION cate_ageini (@age DECIMAL)

    RETURNS VARCHAR AS
    BEGIN
        DECLARE @CATCODE VARCHAR;
        SELECT @CATCODE = [catcode]
        FROM CAT_AGE
        WHERE [DEBUTCAT] < @age AND [FINCAT] > @age;
        RETURN @CATECODE;
    END