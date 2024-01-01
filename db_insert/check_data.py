import csv
import uuid

def get_user_type(type):
    mapping = {
        "student-under-18": 3,
        "student-over-18": 2,
        "school-teacher": 4,
        "subscriber": 3,
        "parents-of-student": 1,
    }
    return mapping.get(type, -1)

insert_str = "INSERT INTO users_mig (id, email, email_verfied_at, password, avatar, created_at, updated_at, first_name, last_name, country, date_of_birth, user_type_id, is_admin) VALUES\n"
with open('user_export_2023-08-09-09-49-34.csv') as csvfile:
    reader = csv.DictReader(csvfile)
    count = 0
    emails = set()
    for row in reader:
        # if count > 5:
        #     break
        if row['user_email'].strip() and row['user_email'].strip() not in emails:
            user_type = get_user_type(row.get('roles', ''))
            if user_type == -1:
                # print("Skipping", row['user_email'], "\t\t\t", row.get('roles', ''))
                continue
            count += 1
            emails.add(row['user_email'])
            insert_str += f"('{uuid.uuid4()}', '{row['user_email']}', '2023-12-28 21:00:00', '{row['user_pass']}', NULL, '2023-12-28 21:00:00', '2023-12-28 21:00:00', '{row.get('first_name', '')}', '{row.get('last_name', '')}', 'Australia', '2000-01-01 00:00:00', '{user_type}', '0'),\n"

insert_str = insert_str[:-2] + ';'
print(insert_str)

