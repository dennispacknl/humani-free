from faker import Faker
import random
import string
import uuid
from datetime import datetime, timedelta
import hashlib

# Initialize Faker
fake = Faker()

def generate_auth_token():
    return uuid.uuid4().hex

def generate_member_sid():
    return ''.join(random.choices(string.ascii_uppercase + string.digits, k=8))

def unique_keygen_meth_padding():
    random_number = random.randint(0, 9999999999)
    padded_number = str(random_number).zfill(10)
    member_id = '10000' + padded_number

    return member_id

def hash_password(password):
    """Create a simple hash of the password"""
    return hashlib.sha256(password.encode()).hexdigest()

def generate_insert_statement(record):
    """Convert a record dictionary to an INSERT statement"""
    columns = ', '.join(record.keys())
    values = ', '.join([f"'{str(value)}'" for value in record.values()])
    return f"INSERT INTO t_members ({columns}) VALUES ({values});"

def generate_fake_records(num_records=100):
    """Generate fake records and return SQL insert statements"""
    used_emails = set()
    insert_statements = []
    
    for _ in range(num_records):
        fname = fake.first_name()
        lname = fake.last_name()
        
        # Ensure email is unique
        while True:
            email = f"{fname.lower()}.{lname.lower()}@{fake.domain_name()}"
            if email not in used_emails:
                used_emails.add(email)
                break
            fname = fake.first_name()
            lname = fake.last_name()
        
        # Generate random dates within the last 2 years
        created_at = fake.date_time_between(start_date='-2y', end_date='now')
        updated_at = created_at + timedelta(days=random.randint(0, 365))
        
        record = {
            'member_sid': generate_member_sid(),
            'member_id': unique_keygen_meth_padding(),
            'm_auth_token': generate_auth_token(),
            'm_email': email,
            'm_password': '00000',
            'm_fname': fname,
            'm_lname': lname,
            'm_phone': fake.phone_number()[:20],
            'profile_pic': 'pfp.png',
            'm_flags': random.choice(['ACTIVE', 'INACTIVE', 'PENDING']),
            'created_at': created_at.strftime('%Y-%m-%d %H:%M:%S'),
            'updated_at': updated_at.strftime('%Y-%m-%d %H:%M:%S')
        }
        
        insert_statements.append(generate_insert_statement(record))
    
    return insert_statements

if __name__ == "__main__":
    # Generate 100 fake records
    statements = generate_fake_records(100)
    
    # Write statements to a file
    with open('RT_SAMPLER.sql', 'w') as f:
        for statement in statements:
            f.write(statement + '\n')
    
    print(f"Successfully generated {len(statements)} INSERT statements in 'RT_SAMPLER.sql'")
